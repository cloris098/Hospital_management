# SQL Manager 2007 for MySQL 4.1.2.1
# ---------------------------------------
# Host     : localhost
# Port     : 3306
# Database : hos_man


SET FOREIGN_KEY_CHECKS=0;

DROP DATABASE IF EXISTS `hos_man`;

CREATE DATABASE `hos_man`
    CHARACTER SET 'latin1'
    COLLATE 'latin1_swedish_ci';

USE `hos_man`;

#
# Structure for the `s_profile` table : 
#

DROP TABLE IF EXISTS `s_profile`;

CREATE TABLE `s_profile` (
  `p_id` int(11) NOT NULL auto_increment COMMENT 'profile id',
  `p_name` varchar(30) NOT NULL COMMENT 'profile name',
  `inputter` varchar(20) NOT NULL,
  `status` char(7) NOT NULL,
  `logtime` varchar(20) NOT NULL COMMENT 'logout time in millisecounds',
  PRIMARY KEY  (`p_id`),
  UNIQUE KEY `p_name` (`p_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Structure for the `s_users` table : 
#

DROP TABLE IF EXISTS `s_users`;

CREATE TABLE `s_users` (
  `userid` int(11) NOT NULL auto_increment,
  `uname` varchar(50) NOT NULL COMMENT 'Staff full name',
  `logname` varchar(20) NOT NULL COMMENT 'login name',
  `passwd` varchar(200) NOT NULL COMMENT 'password',
  `p_id` int(11) NOT NULL,
  `status` char(7) NOT NULL,
  `reset` char(1) NOT NULL,
  PRIMARY KEY  (`logname`),
  UNIQUE KEY `userid` (`userid`),
  UNIQUE KEY `uname` (`uname`),
  KEY `profile` (`p_id`),
  KEY `logname` (`logname`),
  CONSTRAINT `s_users_fk` FOREIGN KEY (`p_id`) REFERENCES `s_profile` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Structure for the `patients` table : 
#

DROP TABLE IF EXISTS `patients`;

CREATE TABLE `patients` (
  `p_id` varchar(15) NOT NULL COMMENT 'Identification number given to patient',
  `Title` varchar(5) NOT NULL,
  `fname` varchar(50) NOT NULL COMMENT 'firstname',
  `surname` varchar(50) NOT NULL COMMENT 'surname',
  `gender` char(6) NOT NULL,
  `date_capt` varchar(20) NOT NULL,
  `status` char(8) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  PRIMARY KEY  (`p_id`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `patients_fk1` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB';

#
# Structure for the `st_dept` table : 
#

DROP TABLE IF EXISTS `st_dept`;

CREATE TABLE `st_dept` (
  `dept_id` varchar(20) NOT NULL,
  `d_name` varchar(50) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  `status` char(7) NOT NULL,
  PRIMARY KEY  (`dept_id`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `st_dept_fk` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `st_roles` table : 
#

DROP TABLE IF EXISTS `st_roles`;

CREATE TABLE `st_roles` (
  `job_id` varchar(10) NOT NULL,
  `j_name` varchar(50) NOT NULL,
  `date_capt` varchar(20) NOT NULL COMMENT 'date captured',
  `inputter` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`job_id`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `st_roles_fk` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `staff` table : 
#

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `st_id` varchar(20) NOT NULL COMMENT 'staff id',
  `f_name` varchar(50) NOT NULL COMMENT 'First Name',
  `l_name` varchar(50) NOT NULL COMMENT 'Last Name',
  `gender` char(6) NOT NULL,
  `m_status` varchar(20) NOT NULL COMMENT 'Marital Status',
  `job_id` varchar(20) NOT NULL COMMENT 'The work of the staff at the hospital eg. nurse, doctor etc.',
  `qualification` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `r_address` varchar(100) NOT NULL COMMENT 'residential address',
  `email` varchar(20) default NULL,
  `dept_id` varchar(20) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  PRIMARY KEY  (`st_id`),
  KEY `dept_id` (`dept_id`),
  KEY `job_id` (`job_id`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `staff_fk` FOREIGN KEY (`dept_id`) REFERENCES `st_dept` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `staff_fk1` FOREIGN KEY (`job_id`) REFERENCES `st_roles` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `staff_fk2` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `drug_issue_header` table : 
#

DROP TABLE IF EXISTS `drug_issue_header`;

CREATE TABLE `drug_issue_header` (
  `rec_id` varchar(20) NOT NULL COMMENT 'receipt id',
  `p_id` varchar(20) NOT NULL,
  `d_issue` date NOT NULL COMMENT 'date issued',
  `st_id` varchar(20) NOT NULL,
  `amt_pd` int(5) NOT NULL COMMENT 'amount paid',
  `amt_left` int(5) NOT NULL COMMENT 'amount left',
  PRIMARY KEY  (`rec_id`),
  KEY `p_id` (`p_id`),
  KEY `st_id` (`st_id`),
  CONSTRAINT `drug_issue_header_fk` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drug_issue_header_fk1` FOREIGN KEY (`st_id`) REFERENCES `staff` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `drug_pay` table : 
#

DROP TABLE IF EXISTS `drug_pay`;

CREATE TABLE `drug_pay` (
  `pm_id` varchar(20) NOT NULL,
  `pm_name` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`pm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='drug payments';

#
# Structure for the `drugs` table : 
#

DROP TABLE IF EXISTS `drugs`;

CREATE TABLE `drugs` (
  `d_id` varchar(20) NOT NULL,
  `d_name` varchar(50) NOT NULL COMMENT 'Name of Drug',
  `r_level` int(5) NOT NULL COMMENT 'Reorder Level: Level that requires the administrator to restock',
  `d_desc` varchar(100) NOT NULL,
  `status` varchar(20) default NULL,
  `st_id` varchar(20) NOT NULL,
  PRIMARY KEY  (`d_id`),
  KEY `st_id` (`st_id`),
  CONSTRAINT `drugs_fk` FOREIGN KEY (`st_id`) REFERENCES `staff` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `drugs_issued` table : 
#

DROP TABLE IF EXISTS `drugs_issued`;

CREATE TABLE `drugs_issued` (
  `d_id` varchar(20) NOT NULL,
  `d_qty_iss` int(5) NOT NULL,
  `d_cost` int(5) NOT NULL,
  `i_date` date NOT NULL,
  `st_id` varchar(20) NOT NULL,
  `p_id` varchar(20) NOT NULL,
  KEY `st_id` (`st_id`),
  KEY `p_id` (`p_id`),
  KEY `d_id` (`d_id`),
  CONSTRAINT `drugs_issued_fk` FOREIGN KEY (`st_id`) REFERENCES `staff` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drugs_issued_fk1` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drugs_issued_fk2` FOREIGN KEY (`d_id`) REFERENCES `drugs` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `drugs_update` table : 
#

DROP TABLE IF EXISTS `drugs_update`;

CREATE TABLE `drugs_update` (
  `d_id` varchar(20) NOT NULL,
  `date_captured` date NOT NULL,
  `d_cost` int(5) NOT NULL,
  `d_qty` int(7) NOT NULL,
  `st_id` varchar(20) NOT NULL,
  KEY `d_id` (`d_id`),
  KEY `st_id` (`st_id`),
  CONSTRAINT `drugs_update_fk` FOREIGN KEY (`d_id`) REFERENCES `drugs` (`d_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `drugs_update_fk1` FOREIGN KEY (`st_id`) REFERENCES `staff` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `equipment` table : 
#

DROP TABLE IF EXISTS `equipment`;

CREATE TABLE `equipment` (
  `equip_id` varchar(20) NOT NULL,
  `e_name` varchar(50) NOT NULL,
  `e_desc` varchar(100) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `st_id` varchar(20) NOT NULL,
  PRIMARY KEY  (`equip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `equip_update` table : 
#

DROP TABLE IF EXISTS `equip_update`;

CREATE TABLE `equip_update` (
  `equip_id` varchar(20) NOT NULL,
  `date_capt` date NOT NULL,
  `e_cost` int(5) NOT NULL,
  `e_qty` int(5) NOT NULL,
  `st_id` varchar(20) NOT NULL,
  KEY `st_id` (`st_id`),
  KEY `equip_id` (`equip_id`),
  CONSTRAINT `equip_update_fk` FOREIGN KEY (`st_id`) REFERENCES `staff` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `equip_update_fk1` FOREIGN KEY (`equip_id`) REFERENCES `equipment` (`equip_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `pat_att_gen` table : 
#

DROP TABLE IF EXISTS `pat_att_gen`;

CREATE TABLE `pat_att_gen` (
  `att_year` char(4) NOT NULL,
  `att_count` int(5) NOT NULL,
  PRIMARY KEY  (`att_year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='patients attendance generator';

#
# Structure for the `pat_attendance` table : 
#

DROP TABLE IF EXISTS `pat_attendance`;

CREATE TABLE `pat_attendance` (
  `attend_id` varchar(20) NOT NULL,
  `p_id` varchar(15) NOT NULL,
  `si` varchar(20) NOT NULL COMMENT 'clinician',
  `nw_fl` varchar(10) NOT NULL COMMENT 'new or followup',
  `doa` varchar(50) NOT NULL COMMENT 'Date of Attendance',
  `t_in` varchar(20) NOT NULL COMMENT 'time of arrival',
  `t_depart` varchar(20) NOT NULL COMMENT 'time of departure',
  `inputter` varchar(20) NOT NULL,
  PRIMARY KEY  (`attend_id`),
  KEY `p_id` (`p_id`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `pat_attend_fk` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pat_attend_fk1` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='patient attendance';

#
# Structure for the `pat_gen` table : 
#

DROP TABLE IF EXISTS `pat_gen`;

CREATE TABLE `pat_gen` (
  `pat_id` varchar(15) NOT NULL,
  `nums` smallint(6) NOT NULL,
  PRIMARY KEY  (`pat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `pat_spon` table : 
#

DROP TABLE IF EXISTS `pat_spon`;

CREATE TABLE `pat_spon` (
  `sp_id` varchar(15) NOT NULL,
  `sp_name` varchar(50) NOT NULL,
  `sp_details` varchar(50) NOT NULL COMMENT 'sponsor details',
  `sp_date` varchar(20) NOT NULL COMMENT 'date captured',
  `status` varchar(7) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  `sp_ct` int(5) NOT NULL auto_increment,
  PRIMARY KEY  (`sp_id`),
  UNIQUE KEY `sp_ct` (`sp_ct`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `pat_spon_fk` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='patient sponsors';

#
# Structure for the `pat_ward_rm` table : 
#

DROP TABLE IF EXISTS `pat_ward_rm`;

CREATE TABLE `pat_ward_rm` (
  `rm_id` varchar(20) NOT NULL,
  `rd_name` varchar(20) NOT NULL,
  `ward_id` varchar(20) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  `status` char(7) NOT NULL,
  PRIMARY KEY  (`rm_id`),
  KEY `inputter` (`inputter`),
  KEY `ward_id` (`ward_id`),
  CONSTRAINT `pat_ward_rm_fk` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pat_ward_rm_fk1` FOREIGN KEY (`ward_id`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='patient ward rooms';

#
# Structure for the `pat_wards` table : 
#

DROP TABLE IF EXISTS `pat_wards`;

CREATE TABLE `pat_wards` (
  `ward_id` varchar(20) NOT NULL,
  `ward_name` varchar(50) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  `status` char(7) NOT NULL,
  PRIMARY KEY  (`ward_id`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `pat_wards_fk` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='patient wards';

#
# Structure for the `patient_details` table : 
#

DROP TABLE IF EXISTS `patient_details`;

CREATE TABLE `patient_details` (
  `p_id` varchar(15) NOT NULL COMMENT 'Identification number given to patient',
  `dbirth` varchar(20) default NULL COMMENT 'Date of Birth',
  `ptel` varchar(30) default NULL COMMENT 'Phone number',
  `email` varchar(30) default NULL,
  `address` varchar(50) default NULL,
  `m_status` varchar(10) default NULL,
  `sp_id` varchar(15) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  KEY `sp_id` (`sp_id`),
  KEY `inputter` (`inputter`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `patients_fk1_new` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patients_fk_new` FOREIGN KEY (`sp_id`) REFERENCES `pat_spon` (`sp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_details_fk` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='InnoDB free: 11264 kB';

#
# Structure for the `problem_type` table : 
#

DROP TABLE IF EXISTS `problem_type`;

CREATE TABLE `problem_type` (
  `prob_id` int(5) NOT NULL auto_increment,
  `problem` varchar(50) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  `status` char(7) NOT NULL,
  `datecap` varchar(15) NOT NULL COMMENT 'date captured',
  PRIMARY KEY  (`prob_id`),
  UNIQUE KEY `problem` (`problem`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `pat_problem_fk` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COMMENT='patient problems';

#
# Structure for the `patient_problems` table : 
#

DROP TABLE IF EXISTS `patient_problems`;

CREATE TABLE `patient_problems` (
  `attend_id` varchar(20) NOT NULL,
  `p_id` varchar(15) NOT NULL,
  `prob_id` int(5) NOT NULL,
  `prob_dur` varchar(10) NOT NULL COMMENT 'problem duration',
  PRIMARY KEY  (`p_id`,`prob_id`,`attend_id`),
  KEY `prob_id` (`prob_id`),
  KEY `p_id` (`p_id`),
  KEY `attend_id` (`attend_id`),
  CONSTRAINT `patient_problems_fk` FOREIGN KEY (`prob_id`) REFERENCES `problem_type` (`prob_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_problems_fk1` FOREIGN KEY (`p_id`) REFERENCES `patients` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `patient_problems_fk2` FOREIGN KEY (`attend_id`) REFERENCES `pat_attendance` (`attend_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='patient and problems reporting';

#
# Structure for the `pro_categ` table : 
#

DROP TABLE IF EXISTS `pro_categ`;

CREATE TABLE `pro_categ` (
  `categ_id` int(5) NOT NULL,
  `categ_name` varchar(60) NOT NULL,
  `date_rec` varchar(15) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  `status` char(7) NOT NULL,
  PRIMARY KEY  (`categ_id`),
  UNIQUE KEY `categ_name` (`categ_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Structure for the `pro_service` table : 
#

DROP TABLE IF EXISTS `pro_service`;

CREATE TABLE `pro_service` (
  `pro_code` char(5) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `pro_cost` double(10,2) NOT NULL,
  `date_rec` varchar(15) NOT NULL,
  `status` char(7) NOT NULL,
  `categ_id` int(5) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  PRIMARY KEY  (`pro_code`),
  KEY `categ_id` (`categ_id`),
  CONSTRAINT `pro_service_fk` FOREIGN KEY (`categ_id`) REFERENCES `pro_categ` (`categ_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='products and services charges';

#
# Structure for the `s_menu_groups` table : 
#

DROP TABLE IF EXISTS `s_menu_groups`;

CREATE TABLE `s_menu_groups` (
  `mg_id` int(11) NOT NULL auto_increment COMMENT 'menu group id',
  `mg_name` varchar(50) NOT NULL COMMENT 'menu group name',
  `floc` varchar(5) default NULL COMMENT 'file location',
  `active` char(1) NOT NULL,
  PRIMARY KEY  (`mg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

#
# Structure for the `s_menus` table : 
#

DROP TABLE IF EXISTS `s_menus`;

CREATE TABLE `s_menus` (
  `m_id` int(11) NOT NULL auto_increment,
  `m_name` varchar(50) NOT NULL COMMENT 'menu name',
  `m_url` varchar(50) NOT NULL,
  `mg_id` int(11) NOT NULL COMMENT 'menu group id',
  `active` char(1) NOT NULL,
  PRIMARY KEY  (`m_id`),
  KEY `mg_id` (`mg_id`),
  CONSTRAINT `s_menus_fk` FOREIGN KEY (`mg_id`) REFERENCES `s_menu_groups` (`mg_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

#
# Structure for the `sp_menus` table : 
#

DROP TABLE IF EXISTS `sp_menus`;

CREATE TABLE `sp_menus` (
  `sp_id` int(11) NOT NULL COMMENT 'profile id',
  `sm_id` int(11) NOT NULL COMMENT 'menu id',
  `smg_id` int(11) NOT NULL COMMENT 'menu group id',
  KEY `sp_id` (`sp_id`),
  KEY `smg_id` (`smg_id`),
  KEY `sm_id` (`sm_id`),
  CONSTRAINT `sp_menus_fk` FOREIGN KEY (`sp_id`) REFERENCES `s_profile` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sp_menus_fk1` FOREIGN KEY (`sm_id`) REFERENCES `s_menus` (`m_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sp_menus_fk2` FOREIGN KEY (`smg_id`) REFERENCES `s_menu_groups` (`mg_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='profile and menus';

#
# Structure for the `staff_roles` table : 
#

DROP TABLE IF EXISTS `staff_roles`;

CREATE TABLE `staff_roles` (
  `st_id` varchar(20) NOT NULL,
  `job_id` varchar(20) NOT NULL,
  `date_capt` varchar(20) NOT NULL,
  `inputter` varchar(20) NOT NULL,
  PRIMARY KEY  (`st_id`,`job_id`,`date_capt`),
  KEY `st_id` (`st_id`),
  KEY `job_id` (`job_id`),
  KEY `inputter` (`inputter`),
  CONSTRAINT `staff_roles_fk` FOREIGN KEY (`st_id`) REFERENCES `staff` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `staff_roles_fk1` FOREIGN KEY (`job_id`) REFERENCES `st_roles` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `staff_roles_fk2` FOREIGN KEY (`inputter`) REFERENCES `s_users` (`logname`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for the `s_profile` table  (LIMIT 0,500)
#

INSERT INTO `s_profile` (`p_id`, `p_name`, `inputter`, `status`, `logtime`) VALUES 
  (-1,'No Profile','admin','active',''),
  (1,'Administrator','admin','active','1800000'),
  (2,'Doctor','admin','active','1800000'),
  (3,'Nurse','admin','active','1200000'),
  (4,'Pharmacist','admin','active','1800000'),
  (5,'Receptionist','admin','active','900000');

COMMIT;

#
# Data for the `s_users` table  (LIMIT 0,500)
#

INSERT INTO `s_users` (`userid`, `uname`, `logname`, `passwd`, `p_id`, `status`, `reset`) VALUES 
  (-1,'Administrator','admin','0192023a7bbd73250516f069df18b500',1,'active','n'),
  (2,'Emmanuel Kwame Siaw Crosby','esiaw','74517ddb8e6e928a3e9b86c19a1e9ec5',3,'active','n');

COMMIT;

#
# Data for the `patients` table  (LIMIT 0,500)
#

INSERT INTO `patients` (`p_id`, `Title`, `fname`, `surname`, `gender`, `date_capt`, `status`, `inputter`) VALUES 
  ('MtZH081401','Ms','Ernestina Adutwumwaa','Boateng','Female','2014-08-11','active','admin'),
  ('MtZH081403','Mrs','Josephine Peres','Hewton','Female','2014-08-11','active','admin'),
  ('MtZH081404','Ms','Henritta','Frimpong','Female','2014-08-11','active','admin'),
  ('MtZH081405','Mr','Alfred','Abankwah Manu','Male','2014-08-11','active','admin'),
  ('MtZH081408','Mr','Solomon','Oppong Abebrese','Male','2014-08-12','active','admin'),
  ('MtZH081410','Mr','Eric Damoah','Oppong','Male','2014-08-13','active','admin'),
  ('MtZH081411','Ms','Juliana','Fordjour','Female','2014-08-13','active','admin');

COMMIT;

#
# Data for the `pat_att_gen` table  (LIMIT 0,500)
#

INSERT INTO `pat_att_gen` (`att_year`, `att_count`) VALUES 
  ('2014',7);

COMMIT;

#
# Data for the `pat_attendance` table  (LIMIT 0,500)
#

INSERT INTO `pat_attendance` (`attend_id`, `p_id`, `si`, `nw_fl`, `doa`, `t_in`, `t_depart`, `inputter`) VALUES 
  ('002014004','MtZH081410','nsi','','2014-08-15','06:58:58 pm','NYD','admin'),
  ('002014005','MtZH081401','esiaw','New','2014-08-15','06:59:10 pm','NYD','admin');

COMMIT;

#
# Data for the `pat_gen` table  (LIMIT 0,500)
#

INSERT INTO `pat_gen` (`pat_id`, `nums`) VALUES 
  ('MtZH0814',13);

COMMIT;

#
# Data for the `pat_spon` table  (LIMIT 0,500)
#

INSERT INTO `pat_spon` (`sp_id`, `sp_name`, `sp_details`, `sp_date`, `status`, `inputter`, `sp_ct`) VALUES 
  ('MtZHPS000000001','Self Sponsor','Self Sponsor','2014-08-09','active','admin',2),
  ('MtZHPS220110803','Sinapi Aba Savings & Loans Ltd','PO Box 4911 Kumasi','2014-08-09','active','admin',1),
  ('MtZHPS224073525','Microfinance Financial Service','Kumasi - A/R','2014-08-13','active','admin',3);

COMMIT;

#
# Data for the `patient_details` table  (LIMIT 0,500)
#

INSERT INTO `patient_details` (`p_id`, `dbirth`, `ptel`, `email`, `address`, `m_status`, `sp_id`, `inputter`) VALUES 
  ('MtZH081401','02/13/1987','0201234567','eaboateng@sinapiaba.com','Sofoline','Single','MtZHPS220110803','admin'),
  ('MtZH081403','04/18/1979','0202260090','jhewtown@sinapiaba.com','IPT Tanoso','Married','MtZHPS220110803','admin'),
  ('MtZH081404','05/15/1989','0547829282','none','Esereso, Atonsu','Single','MtZHPS000000001','admin'),
  ('MtZH081405','06/26/1986','0244567634','alfredabankwa@yahoo.com','Akim-Oda','Single','MtZHPS000000001','admin'),
  ('MtZH081408','08/12/1998','0202260010','solomon@sinapiaba.com','Kwadaso, Kumasi','Married','MtZHPS220110803','admin'),
  ('MtZH081410','02/17/1987','0201234','none','Patasi Estate','Single','MtZHPS000000001','admin'),
  ('MtZH081411','10/08/1986','','','Ahodwo Opposite MPlaza','Single','MtZHPS000000001','admin');

COMMIT;

#
# Data for the `problem_type` table  (LIMIT 0,500)
#

INSERT INTO `problem_type` (`prob_id`, `problem`, `inputter`, `status`, `datecap`) VALUES 
  (1,'Headaches','admin','active','2014-08-08'),
  (2,'Stomach Pains','admin','active','2014-08-08'),
  (3,'Dog Bite','admin','active','2014-08-08'),
  (4,'Abdominal Pain','admin','active','2014-08-08'),
  (5,'Fever','admin','active','2014-08-08'),
  (6,'Back Pain','admin','active','2014-08-08'),
  (7,'Waist Pain','admin','active','2014-08-08'),
  (8,'Wound Dressing','admin','active','2014-08-08'),
  (9,'Running Nostril','admin','active','2014-08-08'),
  (10,'Snake Bite','admin','active','2014-08-08'),
  (11,'Physio','admin','active','2014-08-08'),
  (12,'Malaria','admin','active','2014-08-09'),
  (13,'Typhoid','admin','active','2014-08-09'),
  (14,'Ulcer','admin','active','2014-08-09'),
  (15,'Breast Cancer','admin','active','2014-08-09'),
  (16,'Left Knee Pain','admin','active','2014-08-12');

COMMIT;

#
# Data for the `patient_problems` table  (LIMIT 0,500)
#

INSERT INTO `patient_problems` (`attend_id`, `p_id`, `prob_id`, `prob_dur`) VALUES 
  ('002014005','MtZH081401',1,'Pass 2days'),
  ('002014005','MtZH081401',2,'Pass 3days');

COMMIT;

#
# Data for the `pro_categ` table  (LIMIT 0,500)
#

INSERT INTO `pro_categ` (`categ_id`, `categ_name`, `date_rec`, `inputter`, `status`) VALUES 
  (1,'Fluids & Accessories','2014-08-18','admin','active'),
  (2,'Insulins, Pen & Monitoring Devices','2014-08-18','admin','active'),
  (3,'Services','2014-08-18','admin','active'),
  (4,'Medications','2014-08-18','admin','active'),
  (5,'Bandages, Plasters & Sutures','2014-08-18','admin','active');

COMMIT;

#
# Data for the `pro_service` table  (LIMIT 0,500)
#

INSERT INTO `pro_service` (`pro_code`, `pro_name`, `pro_cost`, `date_rec`, `status`, `categ_id`, `inputter`) VALUES 
  ('30001','Capillary Blood Glucose',5,'2014-08-19','active',3,'admin'),
  ('30002','Medical Report',100,'2014-08-19','active',3,'admin'),
  ('30003','Wound Dressing',10,'2014-08-19','active',3,'admin'),
  ('30004','HIV Screening',15,'2014-08-19','active',3,'admin'),
  ('40001','Aritone',5,'2014-08-19','active',4,'admin'),
  ('40002','Amitriptyline - 14 Tabs',0.5,'2014-08-19','active',4,'admin'),
  ('40003','Amlodipine - Blister Pack Of 10 (5mg)',1,'2014-08-19','active',4,'admin'),
  ('40004','Amlodipine - Blister Pack Of 10 (10mg)',1.5,'2014-08-19','active',4,'admin'),
  ('40005','Amlodipine - Blister Pack Of 14 (10mg)',2,'2014-08-19','active',4,'admin'),
  ('40006','Amlodipine - Box Of 28 Tablets (5mg)',5,'2014-08-19','nactive',4,'admin');

COMMIT;

#
# Data for the `s_menu_groups` table  (LIMIT 0,500)
#

INSERT INTO `s_menu_groups` (`mg_id`, `mg_name`, `floc`, `active`) VALUES 
  (1,'Patient Information Menu','pi','y'),
  (2,'Data Records Menu','dr','y'),
  (3,'Staff Data','std','y'),
  (4,'Drug Store','ds','y'),
  (25,'System Tools Menu','st','y');

COMMIT;

#
# Data for the `s_menus` table  (LIMIT 0,500)
#

INSERT INTO `s_menus` (`m_id`, `m_name`, `m_url`, `mg_id`, `active`) VALUES 
  (1,'User Administration','.',25,'y'),
  (2,'User Profiles','adms',25,'y'),
  (3,'New Patient Record','.',1,'y'),
  (4,'Patient Attendance Record','par',1,'y'),
  (5,'Patient Sponsors','pss',2,'y'),
  (6,'Staff Roles','strs',3,'y'),
  (7,'Staff Records','.',3,'y'),
  (8,'Staff Departments','stdp',3,'y'),
  (9,'Patient Wards','ptws',2,'y'),
  (10,'Patient Ward Rooms','ptwr',2,'y'),
  (11,'Patient Problems','ptpr',1,'y'),
  (12,'New Drugs','.',4,'y'),
  (13,'Patient Observations','pob',1,'y'),
  (14,'List of Patients','lop',1,'y'),
  (15,'Product & Service Category','pasc',2,'y'),
  (16,'Products & Services','pas',2,'y');

COMMIT;

#
# Data for the `sp_menus` table  (LIMIT 0,500)
#

INSERT INTO `sp_menus` (`sp_id`, `sm_id`, `smg_id`) VALUES 
  (1,1,25),
  (1,2,25),
  (2,3,1),
  (2,4,1),
  (1,13,4),
  (1,12,4),
  (1,8,3),
  (1,6,3),
  (1,7,3),
  (1,14,1),
  (1,3,1),
  (1,4,1),
  (1,13,1),
  (1,11,1),
  (3,14,1),
  (3,3,1),
  (3,4,1),
  (3,13,1),
  (1,5,2),
  (1,10,2),
  (1,9,2),
  (1,15,2),
  (1,16,2);

COMMIT;

