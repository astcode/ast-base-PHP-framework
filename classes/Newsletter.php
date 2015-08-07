<?php

class Newsletter {

    private $_db,
            $_data = array();


    public function __construct() {
        $this->_db = DB::getInstance();
        // echo "<pre>";
        // var_dump($this);
        // echo "</pre>";
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function find($id, $table="newsletter") {
            $data = $this->_db->get($table, array('id', '=', $id));
            if ($data->count()) {
                return $this->_data = $data->first();
            }
        return false;
    }

    public function create($fields = array(), $table="newsletter") {
        if (!$this->_db->insert($table, $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function createGuestbook($fields = array()) {
        if (!$this->_db->insert("", $fields)) {
            throw new Exception('There was a problem creating an account.');
        }
    }

    public function update($table="newsletter", $fields = array(), $id = null) {

        if (!$this->_db->update($table, $id, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    public function data() {
        return $this->_data;
    }

    public function getDetails($table="newsletter") {
        return $this->_db->query("SELECT * FROM {$table}");
    }

    public function getGuestbookUsers($table="guestbook") {
        $data = $this->_db->query_assoc("SELECT * FROM {$table} WHERE status = 1 ORDER by id DESC");
        $count = $data->count();
        if ($count) {
            return $data->results();
        }
    }

    public function getDistinctNameFromNewsletterList($table="newsletter_list") {
        $data = $this->_db->query_assoc("SELECT DISTINCT name FROM {$table} WHERE active = 1");
        $i=1;
        $string = "";
        if ($data->count()) {
            foreach($res = $data->results() as $key => $val) {
                $string .= $res[$key]['name'].',';
                if ($i === $data->count()) {
                    $string .= $res[$key]['name'];
                }
                $i++;
            }
            return array_unique(explode(',', $string));

        }
    }

    public function getNewsletterList($table="newsletter_list") {
        $data = $this->_db->query("SELECT * FROM {$table} WHERE active = 1 ORDER by id DESC");
        $count = $data->count();
        if ($count) {
            return $data = $data->results();
        }
    }

    public function getNewsletterListAndSubscribers($table1="newsletter_list", $table2="subscriptions") {
        $data = $this->_db->query("
            SELECT
            guestbook.id AS gb_id,
            guestbook.first_name,
            guestbook.last_name,
            guestbook.`name`,
            guestbook.email,
            guestbook.`status`,
            subscriptions.id AS sub_id,
            subscriptions.gb_user_id,
            subscriptions.nl_id,
            subscriptions.date_subscribed,
            newsletter_list.`id` as campaign_id,
            newsletter_list.`name` as nl_name
            FROM guestbook INNER JOIN subscriptions
            ON  guestbook.id = subscriptions.gb_user_id
            INNER JOIN newsletter_list
            ON subscriptions.nl_id = newsletter_list.id
        ");
        return $data->results();
    }

    public function array_unique_multi($array){
        $copy = $array;
        array_walk($array,create_function('&$v,$k','$v = serialize($v);'));
        $array = array_unique($array);
        return array_intersect_key($copy,$array);
    }

    public function getNewsletterContents(array $vars, array $vars2, $temp) {
        extract($vars); // post data
        extract($vars2);
        /* vars 2
        'to' => $to,
        'first_name' => $first_name,
        'last_name' => $last_name,
        'newsletter_id' => $newsletter_id,
        'campaign_id' => $campaign_id,
        'subscription_id' => $subscription_id,
        'unsubcribeid' => $unsubcribeid
    */
        $html = "";
        // $html = file_get_contents('templates/'.$temp.'/inside.php');
        // $content = str_replace("{CONTENT}", $content, $html);
        // $first_name = str_replace("{FIRST_NAME}", $first_name, $html);
        // $last_name = str_replace("{LAST_NAME}", $last_name, $html);
        // $sender_email = str_replace("{FROM_EMAIL}", $sender_email, $html);
        // $to = str_replace("{TO_EMAIL}", $to, $html);
        // $subject = str_replace("{SUBJECT}", $subject, $html);
        // $sent_date = str_replace("{SENT_DATE}", time(), $html);
        // $newsletter_id = str_replace("{NEWSLETTER_ID}", $newsletter_id, $html);
        // $campaign_id = str_replace("{CAMPAIGN_ID}", $campaign_id, $html);
        // $subscription_id = str_replace("{SUBSCRIPTION_ID}", $subscription_id, $html);
        // $current_year = str_replace("*|CURRENT_YEAR|*", '2015', $html);
        // $company = str_replace("*|LIST:COMPANY|*", $last_name, $html);
        // $content = str_replace("{CONTENT}", $content, $html);
        $replace = array(
            "{CONTENT}","{FIRST_NAME}","{LAST_NAME}","{FROM_EMAIL}","{TO_EMAIL}","{SUBJECT}","{SENT_DATE}","{NEWSLETTER_ID}","{CAMPAIGN_ID}","{SUBSCRIPTION_ID}","*|CURRENT_YEAR|*","{*|LIST:COMPANY|*}"
        );
        $with = array(
            "$content","$first_name","$last_name","$sender_email","$to","$subject",time(),"$newsletter_id","$campaign_id","$subscription_id",2015,"Revival Pages"
        );
        // str_replace("{FIRST_NAME}", $first_name, $html);
            // str_replace("{LAST_NAME}", $last_name, $html);
            // str_replace("{FROM_EMAIL}", $sender_email, $html);
            // str_replace("{TO_EMAIL}", $to, $html);
            // str_replace("{SUBJECT}", $subject, $html);
            // str_replace("{SENT_DATE}", time(), $html);
            // str_replace("{NEWSLETTER_ID}", $newsletter_id, $html);
            // str_replace("{CAMPAIGN_ID}", $campaign_id, $html);
            // str_replace("{SUBSCRIPTION_ID}", $subscription_id, $html);
            // str_replace("*|CURRENT_YEAR|*", '2015', $html);
        // str_replace("*|LIST:COMPANY|*", "Revival Pages", $html);
        ob_start();
        include 'templates/'.$temp.'/inside.html';
        // $page = ob_get_contents();
        // return $file;
        $page = ob_get_clean();
        return str_replace($replace, $with, $page);
    }


}