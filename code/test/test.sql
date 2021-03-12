insert into users(`username`,`password`,`role`) values('gongyansong','123456',2);
insert into doctors(`name`,`tel`,`userid`,`verified`) values('gys','123456',18,0);

insert into users(`username`,`password`,`role`) values('tom','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('tommy','12345678',19,0);

insert into users(`username`,`password`,`role`) values('lion','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('liiiiion','12345678',20,0);

insert into users(`username`,`password`,`role`) values('jack','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('jack','12345678',21,0);

insert into users(`username`,`password`,`role`) values('mikasa','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('mikasa','12345678',22,0);

insert into users(`username`,`password`,`role`) values('liu','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('liu','12345678',23,0);

insert into users(`username`,`password`,`role`) values('wang','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('wang','12345678',24,0);

insert into users(`username`,`password`,`role`) values('lilili','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('liheihei','12345678',25,0);

insert into users(`username`,`password`,`role`) values('feiyuqing','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('fyq','12345678',26,0);

insert into users(`username`,`password`,`role`) values('zhoujielun','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('jaychou','12345678',27,0);

insert into users(`username`,`password`,`role`) values('linjunjie','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('ljj','12345678',28,0);

insert into users(`username`,`password`,`role`) values('llll','123456',1);
insert into clients(`name`,`tel`,`userid`,`verified`) values('hhhhh','123456789',29,0);

	1,首先打开你的CMD，登录MYSQL，选择hospital数据库

2，insert into users(`username`,`password`,`role`) values('wang','123456',3);
	（3代表权限是管理员，2和3在doctors表里面，1在clients表里面）

3，select * from users;
	查看你刚才插入的那一条信息的id是多少，假设为xx

4,insert into doctors(`name`,`tel`,`userid`,`verified`) values('wangwang','123456',48,0);
	（0代表没注册，1反之） 如果刚才role是1 把doctors改成clients

5，根据刚才的用户名密码可以登录了 多重复几遍就注册了几个人