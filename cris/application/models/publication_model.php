<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class publication_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * This method swap the order of two writers of a Publication
     */

    function swap_writers($pub_id, $from, $to) {
        $this->db->select('cfPersId');
        $this->db->where('cfResPublId', $pub_id);
        $this->db->where('cuOrderNum', $from);
        $query = $this->db->get(cfPers_ResPubl);
        /*
         * Get 1st User's Order Number
         */
        $fromid = $query->row();



        $this->db->select('cfPersId');
        $this->db->where('cfResPublId', $pub_id);
        $this->db->where('cuOrderNum', $to);
        $query2 = $this->db->get(cfPers_ResPubl);
        /*
         * Get 2nd User's Order Number
         */
        $toid = $query2->row();
        /*
         * Swap the 2 numbers in a transaction
         */

        $this->db->trans_start();
        $data = array(
            'cuOrderNum' => $to,
        );
        $this->db->where('cfResPublid', $pub_id);
        $this->db->where('cfPersId', $fromid->cfPersId);
        $this->db->update('cfPers_ResPubl', $data);

        $data2 = array(
            'cuOrderNum' => $from,
        );
        $this->db->where('cfResPublid', $pub_id);
        $this->db->where('cfPersId', $toid->cfPersId);
        $this->db->update('cfPers_ResPubl', $data2);
        $this->db->trans_complete();
        /*

         */
    }

    /*
     * This method fetch all publication entries of a user
     */

    function get_all_Publications($userid) {//cfPers_ResPubl
        $this->db->from('cfPers_ResPubl as pr, cfResPubl as r , irResPubl as ir');
        $this->db->where('pr.cfResPublid = r.cfResPublid');
        $this->db->where('ir.cfResPublid = r.cfResPublid');
        $this->db->where('pr.cfPersId', $userid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return FALSE;
        }
    }

    /*
     * This method counts the Publications of the given Department
     */

    function count_dep_Publications($depid) {
        $this->db->from('cfOrgUnit_ResPubl');
        $this->db->where('cfOrg_UnitId', $depid);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /*
     * This method counts all the publications saved in the db
     */

    function count_all_Publications() {
        $this->db->from('cfResPubl');
        $query = $this->db->get();

        return $query->num_rows();
    }

    /*
     * This method counts all the publications of the given user
     */

    function count_user_Publications($userid) {
        $this->db->from('cfPers_ResPubl');
        $this->db->where('cfPersId', $userid);
        $query = $this->db->get();

        return $query->num_rows();
    }

    /*
     * This method fetch all the publications of the given department 
     */

    function get_dep_Publications($depid) {
        $this->db->from('cfOrgUnit_ResPubl');
        $this->db->where('cfOrg_UnitId', $depid);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return FALSE;
        }
    }

    /*
     * This method fetch all the data from the given Publication
     */

    function get_Pub_Data($pubid) {

        $this->db->from('irResPubl as ir, cfResPubl as r');
        $this->db->where('r.cfResPublId', $pubid);
        $this->db->where('r.cfResPublid = ir.cfResPublid');
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /*
     * This methods check if the given user is writer of the given publication 
     */

    function is_writer_of($userid, $pubid) {
        $this->db->where('cfResPublId', $pubid);
        $this->db->where('cfPersId', $userid);
        $query = $this->db->get('cfPers_ResPubl');

        if ($query->num_rows() > 0) {
            //  echo 'mphka';
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /*
     * Get the CollectionID of the department for use in the 
     * remote Institutional Repository
     */

    function get_IrCollectionId($depid) {

        $this->db->select('irCollectionId');
        $this->db->where('cfOrg_UnitId', $depid);
        $query = $this->db->get('cfOrg_Unit');
        foreach ($query->result() as $row) {
            return $row->irCollectionId;
        }
    }

    /*
     * Add a new Publication to the database
     */

    function add_Publication($userid, $depid, $type, $title, $title_sec, $uri, $citation, $sdate, $pubType) {
        //Insert sto cfResPubl  cfTitle,cuTitle_sec, cfResPubData

        $data1 = array(
            'cfTitle' => $title,
            'cuTitle_sec' => $title_sec,
            'cfResPubDate' => $sdate,
            'cfURI' => $uri,
            'cuPubType' => $pubType
        );

        $this->db->trans_start();

        /*
         * Insert the above data to the cfResPubl table
         */
        $this->db->insert('cfResPubl', $data1);

        /*
         * Get publication id
         */
        $pubid = $this->db->insert_id();


        $department = $this->get_IrCollectionId($depid);


        $irserver = $this->config->item('irserver');
        $iruser = $this->config->item('iruser');
        $ircom = $this->config->item('ircommunity');
        /*
         * Create a new Item in the Repository through SOAP call
         */

        $client = new SoapClient($irserver);

        try {
            $params = array(
                'username' => $iruser,
                'comid' => $ircom,
                'colid' => $department
            );

            $result = $client->addThesis($params);
            $itemid = $result->return;
        } catch (Exception $e) {
            
        }


        /*
         * Make the item visible to all
         */
        try {
            $params = array(
                'username' => $iruser,
                'id' => $itemid
            );
            //Call a web service method and send parameters too
            $result = $client->completeSubmission($params);
        } catch (Exception $e) {
            
        }

        $data2 = array(
            'cfResPublId' => $pubid,
            'irItemId' => $itemid,
            'irCollectionId' => $department,
            'irCitation' => $citation
        );
        /*
         * save the above data to table irResPubl
         */
        $this->db->insert('irResPubl', $data2);

        /*
         * Get the metadata from configuration
         */
        $mda = $this->config->item('metadata');


        /*
         * Add the metadata to the Repository
         */
        $this->add_metadata($pubid, $mda['2']['schema'], $mda['2']['element'], $mda['2']['qualifier'], $mda['2']['language'], $title);
        $this->add_metadata($pubid, $mda['3']['schema'], $mda['3']['element'], $mda['3']['qualifier'], $mda['3']['language'], $title_sec);
        $this->add_metadata($pubid, $mda['6']['schema'], $mda['6']['element'], $mda['6']['qualifier'], $mda['6']['language'], $citation);
        $this->add_metadata($pubid, $mda['7']['schema'], $mda['7']['element'], $mda['7']['qualifier'], $mda['7']['language'], convert_str_to_date_for_date_picker($sdate));



        /*
         * Add the user as a writer of the Publication
         */

        $this->add_Pers_to_Publ($pubid, $userid);


        /*
         * Add the Publication to the department
         */
        $this->add_Publ_to_Department($pubid, $depid);


        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return $pubid;
        }
    }

    /*
     * This function add the Publication to the given Department
     */

    function add_Publ_to_Department($pubid, $depid) {
        $data = array(
            'cfResPublId' => $pubid,
            'cfOrg_UnitId' => $depid
        );
        $this->db->insert('cfOrgUnit_ResPubl', $data);
    }

    /*
     * Add the given Publication as part of the given Project
     */

    function add_Publ_to_Project($pubid, $projid) {
        $data = array(
            'cfResPublId' => $pubid,
            'cfProjId' => $projid
        );
        $this->db->insert('cfProj_ResPubl', $data);
    }

    /*
     * Get all projects a associated with the given publication
     */

    function get_projects($pubid) {
        $this->db->from(' cfProj_ResPubl as pr, cfProj as p ');
        $this->db->where('pr.cfProjid = p.cfProjid ');
        $this->db->where('pr.cfResPublId', $pubid);
        $query = $this->db->get('');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /*
     * Get the ItemId for the given Publication, ItemId corresponds to the handle in order to make a SOAP call
     */

    function get_itemid($pubid) {

        $this->db->select('irItemId');
        $this->db->where('cfResPublId', $pubid);
        $query = $this->db->get('irResPubl');
        foreach ($query->result() as $row) {
            return $row->irItemId;
        }
    }

    /*
     * Get name in Greek for the given user
     */

    function get_name_el($persid) {
        $this->db->where('cfPersId', $persid);
        $query = $this->db->get('cfPers');

        foreach ($query->result() as $row) {
            return $row->cuFamilyNames_el . ", " . $row->cuFirstNames_el;
        }
    }

    /*
     * Get name in English for the given user
     */

    function get_name_en($persid) {
        $this->db->where('cfPersId', $persid);
        $query = $this->db->get('cfPers');

        foreach ($query->result() as $row) {
            return $row->cfFamilyNames . ", " . $row->cfFirstNames;
        }
    }

    /*
     * Add the given Person as a writer of the given Publication
     */

    function add_Pers_to_Publ($pubid, $persid) { //mporei na einai kai lista user
        //DspaceWs (DWS)
        //   foreach ($persid as $id) {
        // $this->db->select('count(*)');
        $this->db->where('cfResPublId', $pubid);
        $query = $this->db->get('cfPers_ResPubl');


        $order = $query->num_rows();

        $data = array(
            'cfResPublId' => $pubid,
            'cfPersId' => $persid,
            'cuOrderNum' => $order
        );
        $this->db->insert('cfPers_ResPubl', $data);
        /*
         * Get item id from DB
         */
        $itemid = $this->get_itemid($pubid);

        $irserver = $this->config->item('irserver');
        $iruser = $this->config->item('iruser');
        $client = new SoapClient($irserver);
        $persname = $this->get_name_en($persid);

        try { //Add writer's name to the Repository Item in english
            $params = array(
                'username' => $iruser,
                'id' => $itemid,
                'schema' => 'dc',
                'element' => 'contributor',
                'qualifier' => 'author',
                'language' => 'en',
                'value' => $persname
            );
            //Call a web service method and send parameters too
            $result = $client->addMetadata($params);
        } catch (Exception $e) {
            
        }

        $persname = $this->get_name_el($persid);

        try { //Add writer's name to the Repository Item in Greek
            $params = array(
                'username' => $iruser,
                'id' => $itemid,
                'schema' => 'dc',
                'element' => 'contributor',
                'qualifier' => 'author',
                'language' => 'el',
                'value' => $persname
            );
            //Call a web service method and send parameters too
            $result = $client->addMetadata($params);
        } catch (Exception $e) {
            
        }
    }

    /*
     * This method replaces the specific metadata of the given Publication with the new Value
     */

    function replace_metadata($pubid, $schema, $element, $qualifier, $language, $value) {

        $itemid = $this->get_itemid($pubid);
        $irserver = $this->config->item('irserver');
        $iruser = $this->config->item('iruser');
        $client = new SoapClient($irserver);


        try { //Replace metadata
            $params = array(
                'username' => $iruser,
                'id' => $itemid,
                'schema' => $schema,
                'element' => $element,
                'qualifier' => $qualifier,
                'language' => $language,
                'newvalue' => $value
            );

            //Call a web service method and send parameters too
            $result = $client->changeMetadata($params);
        } catch (Exception $e) {
            echo $e;
        }
    }

    /*
     * Add the given metadata value to the publication through a SOAP call
     */

    function add_metadata($pubid, $schema, $element, $qualifier, $language, $value) {

        $itemid = $this->get_itemid($pubid);
        $irserver = $this->config->item('irserver');
        $iruser = $this->config->item('iruser');
        $client = new SoapClient($irserver);

        try { //Add metadata
            $params = array(
                'username' => $iruser,
                'id' => $itemid,
                'schema' => $schema,
                'element' => $element,
                'qualifier' => $qualifier,
                'language' => $language,
                'value' => $value
            );

            $result = $client->addMetadata($params);
            return $result->return;
        } catch (Exception $e) {
            
        }
    }

    /*
     * This function replace then current file with a new through a SOAP call
     */

    function replace_file($pubid, $file, $name) {

        $this->remove_file($pubid);

        $this->upload_file($pubid, $file, $name);
    }

    /*
     * This function delete the current file associated with the item
     * stored in the Repository. It uses SOAP call.
     */

    function remove_file($pubid) {

        $itemid = $this->get_itemid($pubid);
        //Get configuration
        $irserver = $this->config->item('irserver');
        $iruser = $this->config->item('iruser');
        $client = new SoapClient($irserver);

        try {
            $params = array(
                'username' => $iruser,
                'id' => $itemid,
                'bnumber' => 1
            );
            $result = $client->removeFile($params);
            echo 'allaxa to bitstream';
            $this->edit_BitStreamId($pubid, "-1");
        } catch (Exception $e) {
            
        }
    }

    /*
     * This method adds a new file  associated  with the item
     * stored in the Repository. It uses SOAP call.
     */

    function upload_file($pubid, $file, $name) {

        $itemid = $this->get_itemid($pubid);
        //Get configuration
        $irserver = $this->config->item('irserver');
        $iruser = $this->config->item('iruser');
        $client = new SoapClient($irserver);
        try {
            $params = array(
                'username' => $iruser,
                'id' => $itemid,
                'buf' => $file,
                'name' => $name
            );
            //Add file to repository through SOAP call
            $result = $client->addFile($params);
            $bitid = $result->return;
            //change the bitstreamid in the DB
            $this->edit_BitStreamId($pubid, $bitid);
        } catch (Exception $e) {
            
        }
    }

    /*
     * This function changes the BitStream Id stored in
     * the table irResPubl to the given $bitid
     * Bitid indicates the handle where the user can access 
     * the file from the repository
     */

    function edit_BitStreamId($pubid, $bitid) {
        $data = array(
            'irBitid' => $bitid
        );
        $this->db->where('cfResPublId', $pubid);
        $this->db->update('irResPubl', $data);
    }

    /*
     * This function get all the writers of the given Publication
     */

    function get_members($userid, $pubid) {

        $this->db->from('cfPers_ResPubl as pr, cfPers as p ');
        $this->db->where('pr.cfPersid = p.cfPersid');
        $this->db->where('cfResPublId', $pubid);
        $this->db->order_by('cuOrderNum', 'asc');
        $query = $this->db->get('');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    /*
     * This function updates the data of the publication
     */

    function update($title, $title_sec, $uri, $sdate, $citation, $pubid, $pubType) {

        $data1 = array(
            'cfTitle' => $title,
            'cuTitle_sec' => $title_sec,
            'cfURI' => $uri,
            'cfResPubDate' => $sdate,
            'cuPubType' => $pubType
        );
       /*
        * Update to the DB
        */
        $this->db->where('cfResPublid', $pubid);
        $this->db->update('cfResPubl', $data1);


        $data2 = array(
            'irCitation' => $citation
        );
        $this->db->where('cfResPublid', $pubid);
        $this->db->update('irResPubl', $data2);
        /*
        * Get Configuration
       */ 
        $mda = $this->config->item('metadata');
        
        /*
         * Update the metadata through SOAP 
         */
        $this->replace_metadata($pubid, $mda['2']['schema'], $mda['2']['element'], $mda['2']['qualifier'], $mda['2']['language'], $title);
        $this->replace_metadata($pubid, $mda['3']['schema'], $mda['3']['element'], $mda['3']['qualifier'], $mda['3']['language'], $title_sec);
        $this->replace_metadata($pubid, $mda['6']['schema'], $mda['6']['element'], $mda['6']['qualifier'], $mda['6']['language'], $citation);
        $this->replace_metadata($pubid, $mda['7']['schema'], $mda['7']['element'], $mda['7']['qualifier'], $mda['7']['language'], convert_str_to_date_for_date_picker($sdate));
    }

    /*
     * Update metadata
     */
    function update_meta($abstract_el, $abstract_en, $pubid) {
        $mda = $this->config->item('admeta');
        $this->replace_metadata($pubid, $mda['5']['schema'], $mda['5']['element'], $mda['5']['qualifier'], $mda['5']['language'], $abstract_el);
        $this->replace_metadata($pubid, $mda['4']['schema'], $mda['4']['element'], $mda['4']['qualifier'], $mda['4']['language'], $abstract_en);
    }
    
/*
     * Update subject
     */
    function update_subject($subject_el, $subject_en, $pubid) {
        $mda = $this->config->item('admeta');
        $this->replace_metadata($pubid, $mda['6']['schema'], $mda['6']['element'], $mda['6']['qualifier'], $mda['6']['language'], $subject_en);
        $this->replace_metadata($pubid, $mda['7']['schema'], $mda['7']['element'], $mda['7']['qualifier'], $mda['7']['language'], $subject_el);
    }

    
    /*
     * Retrieve Metadata from the repository through SOAP call
     */
    function getMD($pubid, $schema, $element, $qualifier, $language) {


        $itemid = $this->get_itemid($pubid);
        $irserver = $this->config->item('irserver');
        $iruser = $this->config->item('iruser');
        $client = new SoapClient($irserver);
      
        try { 
            $params = array(
                'username' => $iruser,
                'id' => $itemid,
                'schema' => $schema,
                'element' => $element,
                'qualifier' => $qualifier,
                'language' => $language
            );


            $result = $client->showMetadataValue($params);
            return $result->return; 
        } catch (Exception $e) {
          
        }
    }
/*
 * Retrieve additional metadata from Repository
 */
    function get_admeta($pubid) {
        $mda = $this->config->item('admeta');
        $data = array('1' => $this->getMD($pubid, $mda['4']['schema'], $mda['4']['element'], $mda['4']['qualifier'], $mda['4']['language']),
            '2' => $this->getMD($pubid, $mda['5']['schema'], $mda['5']['element'], $mda['5']['qualifier'], $mda['5']['language']),
        );


        return $data;
    }

/*
 * Get Subject from Repository
 */    
    function get_subject($pubid) {
        $mda = $this->config->item('admeta');
        $data = array('1' => $this->getMD($pubid, $mda['6']['schema'], $mda['6']['element'], $mda['6']['qualifier'], $mda['6']['language']),
            '2' => $this->getMD($pubid, $mda['7']['schema'], $mda['7']['element'], $mda['7']['qualifier'], $mda['7']['language']),
        );


        return $data;
    }

}
