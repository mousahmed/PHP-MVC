<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function searchPosts($search)
    {

        $this->db->query("SELECT *, posts.id as postId,users.id as userId 
FROM posts LEFT JOIN users on posts.user_id = users.id WHERE posts.title LIKE :title ");
        $this->db->bind(':title', '%' . $search . '%');
        $posts = $this->db->resultSet();
        return $posts;
    }

    public function getPosts()
    {
        $this->db->query('SELECT *, posts.id as postId,users.id as userId 
FROM posts INNER JOIN users on posts.user_id = users.id ');
        $posts = $this->db->resultSet();
        return $posts;
    }

    public function create($data)
    {
        $this->db->query('INSERT INTO posts (title,content,user_id) VALUES(:title,:content,:user_id)');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':user_id', $data['user_id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPost($id)
    {
        $this->db->query('SELECT * FROM posts WHERE id = :id ');
        $this->db->bind(':id', $id);
        $post = $this->db->single();
        return $post;
    }


    public function update($data)
    {
        $this->db->query('UPDATE posts SET title = :title, content = :content WHERE id = :id');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
        $this->db->bind(':id', $data['id']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }
}