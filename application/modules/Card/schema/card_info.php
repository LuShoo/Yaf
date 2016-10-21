
/**
*
* @author ziyang <hexiangcheng@showboom.cn>
* @final 2016-04-25
*/



use  card_center_s2_db;

alter table `card_info_copy` add expire_time datetime comment '过期时间',add tag char(16) unique ;


