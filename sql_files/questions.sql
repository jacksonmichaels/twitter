use twitter;

#post tweet
insert into tweets (uid, t_date, t_text) values (1, NOW(), "this is a new tweet");

#Follow or unFollow users
#makes user 1 follow user 20
insert into followers values (1, 20);
#has user 9 unfollow user 2
delete from followers where (follower_id = 9 and followed_id = 2);

#see timeline
#getting timeline for user 1
select uname, t_text, t_date
	from tweets t join 
		(select followed_id from followers where follower_id = 1) a on t.uid = a.followed_id
			join users u on u.uid = a.followed_id
union
	select uname, t_text, r.t_date 
		from retweets r join (select followed_id from followers where follower_id = 1) a on r.uid = a.followed_id
			join tweets t on r.tid = t.tid 
				join users u on u.uid = r.uid
		order by t_date;

#retweet
#has user 1 retweet tweet 5, saying they did it right now
insert into retweets values (5, 1, NOW());

#delete a tweet
delete from retweets
	where tid = 20;

delete from likes
	where tweets_tid = 20;

delete from tweets
	where tid = 20;


#favorite or unfavorite
#makes user 1 favorite tweet 8
insert into likes values(8, 1);
#makes user 1 no longer favorite tweet 8;
delete from likes where (tweets_tid = 8 and users_uid = 1);

#see favorited tweets
#checking for user 4
select tid, t_text
	from users u join likes l on u.uid = l.users_uid
		join tweets t on l.tweets_tid = t.tid
	where u.uid = 4;

#see who a user is following
#checking what users number 6 is following
select u.uname 
	from users u 
		where u.uid in (
			select followed_id from followers where follower_id = 6);

#see followers
#checking what users are following user 1
select u.uname 
	from users u 
		where u.uid in (
			select follower_id from followers where followed_id = 1);

#favs on tweet
#checking number of favs for tweet number 2
select count(*) as 'likes' 
	from likes 
		where tweets_tid = 2;

#retweets on tweet
#checking for tweet numer 4
select count(*) as 'retweets' 
	from retweets 
		where tid = 4;

#num followers
#checking for number 20
select count(*) as 'followers'
	from users u 
		where u.uid in (
			select follower_id from followers where followed_id = 1);
            
#num following
#checking for user 19
select count(*) as 'num following'
	from users u 
		where u.uid in (
			select followed_id from followers where follower_id =19);