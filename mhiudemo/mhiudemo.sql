CREATE TABLE listShop (
                       shopId int not null auto_increment,
                       name NVARCHAR(40) not null ,
                       address varchar(85) not null,
                       tel int not null ,
                       available int,
                       primary key (shopid)
) engine=innoDB DEFAULT CHARSET = utf8 auto_increment = 19;

insert into listShop values
                      (1, 'LV', 'HaNoi', 0123123, 1),
                      (2, 'Gucci', 'DaNang', 5767556, 1),
                      (3, 'Cha neo', 'X', 2342342, 1),
                      (4, 'BongXink', 'CaMau', 567456, 1),
                      (5, 'BanhQuan', 'HaNoi', 0123563, 1);

select * from listShop;
drop table listShop;