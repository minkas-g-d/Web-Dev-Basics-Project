<?php

namespace Models;


class Posts extends \MDF\BaseModel {

    public function listFullInfo() {
        return $this->db->prepare('SELECT * FROM mdf_posts ORDER BY post_date DESC')->execute()->fetchAllAssoc();
    }

    public function listPartialInfo() {
        return $this->db->prepare("SELECT mp.id, mp.title, mp.excerpt, mp.post_image, mp.post_date, mu.username
          FROM mdf_posts mp
          JOIN mdf_users mu
           ON mp.author_id = mu.id
          WHERE mp.post_status = 'published'
          ORDER BY post_date DESC")->execute()->fetchAllAssoc();
    }

    public function getPost($id) {

        if(\MDF\Validator::numeric($id)) {

            $id = \MDF\Common::normalize($id,'int');

            return $this->db->prepare("SELECT mp.id, mp.title, mp.content, mp.post_image, mp.post_date, mu.username
              FROM mdf_posts mp
              JOIN mdf_users mu
               ON mp.author_id = mu.id
              WHERE mp.id = ?
              ORDER BY post_date DESC", array($id))->execute()->fetchRowAssoc();
        } else {
            throw new \Exception('ID NOT VALID');
        }
    }

    public function addPost($authorId, $title, $content, $excerpt = null) {
        if($excerpt == null) {
            $excerpt = \MDF\Common::truncate($content, 150);
        }
        $result = $this->db->prepare('INSERT INTO mdf_posts (author_id, title, content, excerpt, post_date)
          VALUES (?, ?, ?, ?, ?)',
            array($authorId, $title, $content, $excerpt, date('Y-m-d H:i:s')))->execute()->getLastInsertedId();

        return $result;

    }

}