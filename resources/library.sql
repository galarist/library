DROP DATABASE IF EXISTS library;
CREATE DATABASE library;
USE library;

/*CREATE USERS TABLE*/
CREATE TABLE users (
    userID int,
    permission int,
    lastName varchar(255),
    firstName varchar(255),
    userName varchar(255),
    email varchar(255),
    password varchar(255),
    PRIMARY KEY (userID)
);

/*CREATE TABLE FOR BOOKS*/
CREATE TABLE books (
    bookID int,
    title varchar(255),
    author varchar(255),
    bookPlot varchar(255),
    ranking int,
    cover varchar(255),
    PRIMARY KEY (bookID)
)