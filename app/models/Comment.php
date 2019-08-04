<?php

class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getComments()
    {
        $this->db->query('SELECT *,comments.content as commentContent,posts.id as postId, users.id as userId,comments.id as commentId  
FROM comments INNER JOIN users on comments.user_id = users.id INNER JOIN posts on comments.post_id = posts.id');
        $posts = $this->db->resultSet();
        return $posts;
    }

    public function getPostComments($id)
    {
        $this->db->query('SELECT *,comments.content as commentContent, users.id as userId,comments.id as commentId  
FROM comments LEFT JOIN users on comments.user_id = users.id  WHERE  comments.post_id = :id');
        $this->db->bind(':id', $id);
        $comments = $this->db->resultSet();
        return $comments;
    }

    public function update($data)
    {
        $this->db->query('UPDATE comments SET status = :status WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':status', $data['status']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function create($data)
    {
        $this->db->query('INSERT INTO comments (content,user_id,post_id) VALUES(:content,:user_id,:post_id)');

        $this->db->bind(':content', $data['content']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}