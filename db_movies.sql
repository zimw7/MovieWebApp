-- File Name: db_movies.sql
-- Create Date: November 18, 2023 
-- Description: This file contains the SQL code to create the database and tables for the db_movies project.

-- Create the database
CREATE DATABASE IF NOT EXISTS db_movies;
GRANT USAGE ON *.* TO 'user1'@'user1' IDENTIFIED BY 'pass1';
GRANT ALL PRIVILEGES ON db_movies.* TO 'user1'@'localhost';
FLUSH PRIVILEGES;

USE db_movies;

-- Create Users Table
CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Create Genres Table
CREATE TABLE IF NOT EXISTS genres (
    genre_id INT AUTO_INCREMENT PRIMARY KEY,
    genre_title VARCHAR(255) NOT NULL
);

-- Create Movies Table with poster_url and movie_rating
CREATE TABLE IF NOT EXISTS movies (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    movie_title VARCHAR(255) NOT NULL,
    genre_id INT NOT NULL,
    year YEAR NOT NULL,
    director VARCHAR(255) NOT NULL,
    poster_url VARCHAR(255) NOT NULL,  
    movie_rating VARCHAR(255)        
);

-- Populate the users table
INSERT INTO users (username, password) VALUES ('user1', 'pass1');
INSERT INTO users (username, password) VALUES ('user2', 'pass2');

-- Populate the genres table
INSERT INTO genres (genre_title) VALUES ('Action');
INSERT INTO genres (genre_title) VALUES ('Comedy');
INSERT INTO genres (genre_title) VALUES ('Drama');
INSERT INTO genres (genre_title) VALUES ('Sci-Fi');
INSERT INTO genres (genre_title) VALUES ('Horror');
INSERT INTO genres (genre_title) VALUES ('Adventure');
INSERT INTO genres (genre_title) VALUES ('Romance');
INSERT INTO genres (genre_title) VALUES ('Thriller');

-- Populate the movies table
INSERT INTO movies (movie_title, genre_id, year, director, poster_url, movie_rating) VALUES 
('Pulp Fiction', 3, 1994, 'Quentin Tarantino', 'https://www.themoviedb.org/t/p/original/vQWk5YBFWF4bZaofAbv0tShwBvQ.jpg', '9.1'),
('The Pianist', 3, 2002, 'Roman Polanski', 'https://www.themoviedb.org/t/p/original/2hFvxCCWrTmCYwfy7yum0GKRi3Y.jpg', '9.2'),
('Joker', 8, 2019, 'Todd Phillip', 'https://www.themoviedb.org/t/p/original/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg', '8.9'),
('Green Book', 2, 2018, 'Peter Farrelly', 'https://www.themoviedb.org/t/p/original/7BsvSuDQuoqhWmU2fL7W2GOcZHU.jpg', '8.9'),
('Interstellar', 4, 2014, 'Christopher Nolan', 'https://www.themoviedb.org/t/p/original/gEU2QniE6E77NI6lCU6MxlNBvIx.jpg', '9.3'),
('Kill Bill: Vol. 1', 1, 2003, 'Quentin Tarantino', 'https://www.themoviedb.org/t/p/original/v7TaX8kXMXs5yFFGR41guUDNcnB.jpg', '8.9'),
('Spirited Away', 6, 2001, 'Hayao Miyazaki', 'https://www.themoviedb.org/t/p/original/39wmItIWsg5sZMyRUHLkWBcuVCM.jpg', '9.1'),
('Life Is Beautiful', 7, 1997, 'Roberto Benigni', 'https://www.themoviedb.org/t/p/original/mfnkSeeVOBVheuyn2lo4tfmOPQb.jpg', '8.7'),
('Get Out', 5, 2017, 'Jordan Peele', 'https://www.themoviedb.org/t/p/original/tFXcEccSQMf3lfhfXKSU9iRBpa3.jpg', '8.6'),
('Big Fish', 6, 2003, 'Tim Burton', 'https://www.themoviedb.org/t/p/original/tjK063yCgaBAluVU72rZ6PKPH2l.jpg', '8.9'),
('The Shawshank Redemption', 3, 1994, 'Frank Darabont', 'https://www.themoviedb.org/t/p/original/q6y0Go1tsGEsmtFryDOJo3dEmqu.jpg', '8.8'),
('Inception', 4, 2010, 'Christopher Nolan', 'https://www.themoviedb.org/t/p/original/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg', '9.2'),
('Fight Club', 1, 1999, 'David Fincher', 'https://www.themoviedb.org/t/p/original/pB8BM7pdSp6B6Ih7QZ4DrQ3PmJK.jpg', '8.6'),
('Forrest Gump', 3, 1994, 'Robert Zemeckis', 'https://www.themoviedb.org/t/p/original/arw2vcBveWOVZr6pxd9XTd1TdQa.jpg', '8.9'),
('The Matrix', 4, 1999, 'Lana Wachowski', 'https://www.themoviedb.org/t/p/original/f89U3ADr1oiB1s9GkdPOEpXUk5H.jpg', '8.5'),
('Parasite', 3, 2019, 'Bong Joon-ho', 'https://www.themoviedb.org/t/p/original/7IiTTgloJzvGI1TAYymCfbfl3vT.jpg', '8.9'),
('Se7en', 5, 1995, 'David Fincher', 'https://www.themoviedb.org/t/p/original/6yoghtyTpznpBik8EngEmJskVUO.jpg', '8.6'),
('The Silence of the Lambs', 5, 1991, 'Jonathan Demme', 'https://www.themoviedb.org/t/p/original/uS9m8OBk1A8eM9I042bx8XXpqAq.jpg', '8.5'),
('The Dark Knight', 1, 2008, 'Christopher Nolan', 'https://www.themoviedb.org/t/p/original/qJ2tW6WMUDux911r6m7haRef0WH.jpg', '8.6');

-- Create the foreign key
ALTER TABLE movies
ADD FOREIGN KEY (genre_id) REFERENCES genres(genre_id);
