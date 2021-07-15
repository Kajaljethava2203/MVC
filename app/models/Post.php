<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query('SELECT * ,
                                posts.id as postId,
                                users.id as userId,
                                posts.created_at as postCreated,
                                users.created_at as userCreated
                            FROM posts
                            INNER JOIN users
                            ON posts.user_id=users.id
                            ORDER BY posts.created_at DESC 
                            ');

        $results = $this->db->resultSet();
        return $results;
    }
    public function getComments($id){
        $this->db->query('SELECT
                                comments.comment_id as commentId,
                                comments.user_id as userId,
                                comments.created_at as commentCreated,
                                comments.comment as commentText,
                                users.name as userName
                                FROM comments
                                INNER JOIN users
                                ON comments.user_id = users.id
                                WHERE comments.id = :post_id
                                ORDER BY comments.created_at DESC
                                ');

        $this->db->bind(':post_id',$id);

        $this->db->execute();
        $results = $this->db->resultSet();
        return $results;
    }

    public function addPost($data)
    {

        $this->db->query('INSERT INTO posts (title ,user_id,body) VALUES (:title ,:user_id,:body)');

        //Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePost($data)
    {

        $this->db->query('UPDATE posts SET title = :title , body = :body WHERE id = :id');

        //Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id',$id);

        $row=$this->db->single();

        return $row;
    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE id = :id');

        //Bind values
        $this->db->bind(':id',$id);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addComment($data)
    {
        $this->db->query('INSERT INTO comments (user_id,id,comment) VALUES (:user_id,:id,:comment)');

        //Bind values

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':comment', $data['comment']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteComment($id)
    {
        $this->db->query('DELETE FROM comments WHERE comment_id = :id');

        //Bind values
        $this->db->bind(':id',$id);


        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addReplay($data)
    {
        $this->db->query('INSERT INTO comments (user_id,id,parent_comment_id,comment) VALUES (:user_id,:id,:parent_comment_id,:comment)');

        //Bind values

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':parent_comment_id', $data['parent_comment_id']);
        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}