CREATE TABLE user 
(
uid INTEGER NOT NULL AUTO_INCREMENT,
uname VARCHAR(255),
address VARCHAR(255),
email VARCHAR(255),
password INTEGER,
profile VARCHAR(255),
bid INTEGER,
time TIMESTAMP,
PRIMARY KEY(uid)
);

UPDATE user SET profile=? WHERE uid=?;
UPDATE user SET bid=? WHERE uid=?;


CREATE TABLE thread
(
tid INTEGER NOT NULL AUTO_INCREMENT,
title VARCHAR(255),
uid INTEGER,
time TIMESTAMP,
scope CHARACTER(1),
PRIMARY KEY(tid),
FOREIGN KEY(uid) REFERENCES user(uid)
);



CREATE TABLE receive
(
uid INTEGER,
tid INTEGER,
PRIMARY KEY(uid, tid),
FOREIGN KEY(uid) REFERENCES user(uid),
FOREIGN KEY (tid) REFERENCES thread(tid)
);



CREATE TABLE message
(
mid INTEGER NOT NULL AUTO_INCREMENT,
time TIMESTAMP,
content VARCHAR(255),
coordinate VARCHAR(255),
Tid INTEGER,
uid INTEGER,
rid INTEGER,
PRIMARY KEY(mid),
FOREIGN KEY (uid) REFERENCES user(uid),
FOREIGN KEY (tid) REFERENCES thread(tid)
);



CREATE TABLE friend
(
aid INTEGER,
bid INTEGER,
agree CHAR(1),
PRIMARY KEY(aid, bid),
FOREIGN KEY(aid) REFERENCES user(uid),
FOREIGN KEY(bid) REFERENCES user(uid)
);


CREATE TABLE neighbor
(
aid INTEGER,
bid INTEGER,
PRIMARY KEY(aid, bid),
FOREIGN KEY(aid) REFERENCES user(uid),
FOREIGN KEY(bid) REFERENCES user(uid)
);






CREATE TABLE request_table
(
bid INTEGER,
uid INTEGER,
PRIMARY KEY(bid, uid),
FOREIGN KEY(bid) REFERENCES block(bid),
FOREIGN KEY(uid) REFERENCES user(uid)
);



CREATE TABLE hood
(
hid INTEGER,
hname VARCHAR(255),
PRIMARY KEY(hid)
);



CREATE TABLE block
(
bid INTEGER, 
bname VARCHAR(255),
hid INTEGER,
PRIMARY KEY(bid),
FOREIGN KEY(hid) REFERENCES hood(hid)
);

CREATE TABLE join_table
(
bid INTEGER,
uid INTEGER,
agreeid INTEGER,
FOREIGN KEY(bid) REFERENCES block(bid),
FOREIGN KEY(uid) REFERENCES user(uid)
);

INSERT INTO request_table
VALUES(?, ?);

INSERT INTO join_table
VALUES(?, ?, ?);


SELECT * FROM user
WHERE uname=? AND password=?;

INSERT INTO user(uname, address, zip, email, password, sex, profile, bid, time) VALUES ("Eason", "8918 3rd, BayRidge",11208, "947995698@qq.com", 1, 'M', "Love", 1, "2015-11-11 13:23:44");
INSERT INTO user(uname, address, zip, email, password, sex, profile, bid, time) VALUES ("John", "8914 3rd, BayRidge",11208, "947995698@qq.com", 1, 'M', "Love", 1, "2015-11-21 13:23:44");
INSERT INTO user(uname, address, zip, email, password, sex, profile, bid, time) VALUES ("lynn", "8913 3rd, BayRidge",11208, "947995698@qq.com", 1, 'M', "Love", 1, "2015-10-20 13:23:44");
INSERT INTO user(uname, address, zip, email, password, sex, profile, bid, time) VALUES ("Jojo", "8915 3rd, BayRidge",11208, "947995698@qq.com", 1, 'M', "Love", 1, "2015-11-21 13:25:44");
INSERT INTO user(uname, address, zip, email, password, sex, profile, bid, time) VALUES ("Peter", "8914 3rd, BayRidge",11208, "947995698@qq.com", 1, 'M', "Love", 1, "2015-11-22 13:23:44");
INSERT INTO user(uname, address, zip, email, password, sex, profile, bid, time) VALUES ("Higer", "8914 3rd, BayRidge",11208, "947995698@qq.com", 1, 'M', "Love", 1, "2015-11-21 13:23:44");
INSERT INTO user(uname, address, zip, email, password, sex, profile, time) VALUES ("Jiang", "8914 3rd, BayRidge",11208, "947995698@qq.com", 1, 'M', "Love", "2015-11-21 13:23:44");


INSERT INTO thread(title, uid, time, ) VALUES (?, ?, ?);
INSERT INTO thread(title, uid, time) VALUES ("lost and found", 1,  "2015-11-11 12:23:44");
INSERT INTO thread(title, uid, time) VALUES ("lost and found", 1,  "2015-11-11 12:24:44");


INSERT INTO receive VALUES(2, 1);
INSERT INTO receive VALUES(3, 1);
INSERT INTO receive VALUES(4, 1);
INSERT INTO receive VALUES(1, 2);
INSERT INTO receive VALUES(2, 2);
INSERT INTO receive VALUES(3, 2);
INSERT INTO receive VALUES(4, 2);
INSERT INTO receive VALUES(5, 2);
INSERT INTO receive VALUES(6, 2);


INSERT INTO message (time, content, coordinate, tid, uid, rid) VALUES("2015-11-23 12:23:44", "A key", "Bay Ridge", 3, 1, 2 );
INSERT INTO message (time, content, coordinate, tid, uid, rid) VALUES("2015-11-23 12:23:44", "A key", "Bay Ridge", 2, 3, 1 );
INSERT INTO message (time, content, coordinate, tid, uid, rid) VALUES("2015-11-11 12:23:44", "A key", "Bay Ridge", 2, 4, 1 );
INSERT INTO message (time, content, coordinate, tid, uid, rid) VALUES("2015-11-23 12:23:44", "A key", "Bay Ridge", 2, 5, 1 );

INSERT INTO message (time, content, tid, coordinate, uid) VALUES(?, ?, ?, ?, ?);

INSERT INTO friend VALUES (1, 2, 'Y');
INSERT INTO friend VALUES (1, 3, 'Y');
INSERT INTO friend VALUES (1, 4, 'Y');
INSERT INTO friend VALUES (2, 1, 'Y');
INSERT INTO friend VALUES (3, 1, 'Y');
INSERT INTO friend VALUES (4, 1, 'Y');
INSERT INTO friend VALUES (4, 2, 'N');

open the friend list
SELECT uname FROM friend, user 
WHERE aid=? AND friend.bid=uid;


INSERT INTO neighbor VALUES(1, 2);
INSERT INTO neighbor VALUES(1, 3);
INSERT INTO neighbor VALUES(1, 4);
INSERT INTO neighbor VALUES(1, 5);
INSERT INTO neighbor VALUES(1, 6);
INSERT INTO neighbor VALUES(2, 1);
INSERT INTO neighbor VALUES(3, 1);
INSERT INTO neighbor VALUES(4, 1);
INSERT INTO neighbor VALUES(5, 1);
INSERT INTO neighbor VALUES(6, 1);


INSERT INTO join_table VALUES(1, 7, 1);


INSERT INTO request_table VALUES(1, 7);

INSERT INTO  hood VALUES(1, "Bay Ridge");

INSERT INTO block VALUES(1, "85th street", 1);
INSERT INTO block VALUES(2, "86th street", 1);
INSERT INTO block VALUES(3, "87th street", 1);
INSERT INTO block VALUES(4, "88th street", 1);

-- ------user sign up-----------
INSERT INTO user VALUES(?,?,?,?,?,?,?);
UPDATE user set uname=?, address=?, zip=?, email=?, password=?, sex=?, profile=?;
UPDATE user set profile=?;

-- ------
-- ------apply to become members of a block--------
-- input: $uid, $bid
-- ------
INSERT INTO request_table VALUES(?, ?);
INSERT INTO join_table VALUES(?, ?, ?);

-- for a block member to comfirm--
SELECT uid, uname, sex, address, email 
FROM user NATURAL JOIN request 
WHERE request.bid = $bid;

DELETE join_table 

INSERT INTO join_table VALUES($uid, $bid, $userid);

INSERT INTO user(bid) VALUES ($bid);

DELETE FROM join_table WHERE uid = $uid, bid = $bid;

-- a user starts a new thread by posting a new message
-- input $uname, $uid, $range, $timestamp, $content, $coordinate, $title

INSERT INTO thread VALUES($title, $timestamp, $uid);
-- get Tid
INSERT INTO message VALUES($uname, NOW(), $content, $coordinate, $Tid, $uid, rid = NULL);

-- reply
-- input $tid $uid $rid
INSERT INTO message VALUES($uname, NOW(), %content, $condinate, $tid, $uid, $rid);
UPDATE thread SET timestamp = NOW() WHERE thread.tid = $tid;

-- a user's view of point;
-- input: $uid, $bid

-- (1) friend feeds;
SELECT * FROM message NATURAL JOIN thread NATURAL JOIN receive WHERE thread.time > (SELECT time FROM user where uid = $uid) AND receive.uid = $uid AND thread.uid in (SELECT bid FROM friend WHERE aid = $uid) GROUP BY thread.tid ORDER BY message.time;
-- (2) neighbor feeds;
SELECT * FROM message NATURAL JOIN thread NATURAL JOIN receive WHERE receive.uid = $uid AND thread.uid in (SELECT bid FROM neighbor WHERE aid=$uid) GROUP BY thread.tid ORDER BY message.timestamp;
-- (3) block feeds;
SELECT * FROM message NATURAL JOIN thread NATURAL JOIN receive NOTURAL JOIN user WHERE recieve.uid = $uid AND user.bid = $bid GROUP BY thread.tid ORDER BY message.time;


edit:
SELECT tid, title, thread.time, thread.uid FROM thread, user 
WHERE thread.uid=user.uid AND user.bid=1 AND scope=“b”;

SELECT user.uname, content, message.time, coordinate, tid 
FROM message, user WHERE message.uid=user.uid AND tid=?;


-- (4) hoods feeds;
SELECT * FROM message NATURAL JOIN thread NATURAL JOIN receive NOTURAL JOIN user WHERE nid = (SELECT nid FROM block WHERE bid = $bid) GROUP BY thread.tid ORDER BY message.timestamp;


-- threads with newmessages posted since the last time the user visited the site;
-- a user log out
UPDATE user SET time= NOW();
SELECT * FROM message WHERE thread.timestamp > user.timestamp AND message.uid in (SELECT bid FROM friend WHERE aid = $uid);

-- a user add or accept friend;
-- input $id
SELECT * FROM friend, user WHERE friend.bid = $uid AND friend.aid = user.aid AND agree = 'N';
INSERT INTO friend VALUES($uid, $bid, 'N');
INSERT INTO friend VALUES($bid, $uid, 'Y');
UPDATE friend SET agree = 'Y' WHERE friend.bid = $uid AND friend.aid = $aid;

-- list all their current friend or neighbor;
SELECT * FROM friend WHERE aid = $uid AND agree = 'Y';
SELECT * FROM neighbor WHERE aid = $uid;








select * from message;

SELECT * FROM message, receive, thread WHERE message.tid = thread.tid AND thread.tid = receive.tid AND receive.uid = 2;

-- (1) when John login, friend fees;
SELECT * FROM message, thread, receive WHERE message.tid = thread.tid AND thread.tid = receive.tid AND thread.time > (SELECT time FROM user where uid = 2) AND receive.uid = 2 AND thread.uid in (SELECT bid FROM friend WHERE aid = 2) GROUP BY thread.tid ORDER BY message.time;

SELECT * FROM message, thread, receive WHERE message.tid = thread.tid AND thread.tid = receive.tid AND receive.uid = 2 AND thread.time > (SELECT time FROM user where uid = 2) AND thread.uid in (SELECT bid FROM neighbor WHERE aid=2) GROUP BY thread.tid ORDER BY message.time;

SELECT * FROM message, thread, receive, user WHERE user.bid = 1 AND message.tid = thread.tid AND thread.tid = receive.tid AND user.uid = message.uid AND receive.uid = 2 AND thread.time > (SELECT time FROM user where uid = 2)  GROUP BY thread.tid ORDER BY message.time;

SELECT * FROM message, thread, receive, user, block WHERE block.bid = user.bid AND message.uid = user.uid AND message.tid = thread.tid AND thread.tid = receive.tid AND receive.uid = 2 AND block.hid = 1 AND thread.time > (SELECT time FROM user where uid = 2)  GROUP BY thread.tid ORDER BY message.time;

SELECT * FROM friend, user WHERE friend.bid = 2 AND friend.aid = user.uid AND agree = 'N';

SELECT * FROM friend, user WHERE friend.bid = 2 AND friend.aid = user.uid AND agree = 'Y';

SELECT * FROM join_table WHERE join_table.bid = 1;



