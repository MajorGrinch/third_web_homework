CREATE TABLE Stu_User(
	account VARCHAR(15),
	pwd		VARCHAR(30),
	name 	VARCHAR(20),
	sel_prj VARCHAR(50),
	par_prj VARCHAR(50),
	PRIMARY KEY(account)
);

CREATE TABLE Tch_User(
	account VARCHAR(15),
	pwd		VARCHAR(30),
	name 	VARCHAR(20),
	my_prj	VARCHAR(15),
	PRIMARY KEY(account)
);

CREATE TABLE Project(
	prj_name	VARCHAR(50),
	selected 	INT,
	prj_num		VARCHAR(15),
	instructor	VARCHAR(20),
	intro      	VARCHAR(200),
	applicant	VARCHAR(20),
	fina_lv		INT,
	property	VARCHAR(20),
	curr_mem	INT,
	curr_state	VARCHAR(20),
	start_data 	DATE,
	finish_date DATE,
	PRIMARY KEY(prj_num)
);

CREATE TABLE Team(
	num  	VARCHAR(15),
	leader	VARCHAR(15),
	mber_1	VARCHAR(15),
	mber_2	VARCHAR(15),
	mber_3 	VARCHAR(15),
	PRIMARY KEY(num)
);

CREATE TABLE Prj_Log(
	prj_num     VARCHAR(15),
	content		VARCHAR(500)
);

CREATE TABLE Selelc(
	stu 	VARCHAR(15),
	prj 	VARCHAR(15),
	PRIMARY KEY(stu)
)