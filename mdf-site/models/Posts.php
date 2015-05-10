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

    public function changePostState($authorId, $postId, $newState) {

        if(in_array($newState, array('published', 'draft', 'deleted'))) {
            if($this->checkPostPossession($authorId, $postId)) {
                $result = $this->db->prepare("UPDATE mdf_posts
                  SET post_status=?, post_modified=?
                  WHERE id=?",
                    array($newState, date('Y-m-d H:i:s'), $postId))->execute()->getAffectedRows();

                if($result === 0) {
                    throw new \Exception('Could not delete post!');
                }

            } else {
                throw new \Exception('Cannot delete others posts!');
            }

        } else {
            throw new \Exception('No such state: ' . $newState);
        }

    }

    public function checkPostPossession($uid, $postId) {
        return (bool) $this->db->prepare("SELECT id FROM mdf_posts WHERE author_id = ? AND id = ?",
            array($uid, $postId))->execute()->fetchRowNum();
    }


}