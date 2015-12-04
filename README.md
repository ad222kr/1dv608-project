#1dv608 - Project
Repository for the project in the course Web development with php

##Written essay about the project
[Can be found here](https://docs.google.com/document/d/1aq3VP5VokMfXT0wbolyq2_nbvumBJw40uL2SH3c1-Jk/edit?usp=sharing)

##Installation
The project uses PHP version 5.6, so the webserver needs support for this version or higher.
The project uses a MySQL database, and is accessed with the mysqli-extension for php  
*Download/clone the repository. Drop the files to a webserver.
*Create a databse with these 3 tables
```SQL
CREATE TABLE `beers` (
  `beerid` varchar(255) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `abv` double NOT NULL,
  `brewery` varchar(100) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `imageurl` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `country` varchar(70) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `volume` double NOT NULL,
  `servingtype` varchar(20) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`beerid`),
  UNIQUE KEY `beerid_UNIQUE` (`beerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pub_beer` (
  `pubid` varchar(255) NOT NULL,
  `beerid` varchar(255) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`pubid`,`beerid`),
  KEY `beersid` (`beerid`),
  CONSTRAINT `beersid` FOREIGN KEY (`beerid`) REFERENCES `beers` (`beerid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pubid` FOREIGN KEY (`pubid`) REFERENCES `pubs` (`pubid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pubs` (
  `pubid` varchar(255) NOT NULL,
  `name` varchar(80) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `adress` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `webpageurl` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`pubid`),
  UNIQUE KEY `pubid_UNIQUE` (`pubid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
* Create the stored procedures
```SQL
DELIMITER $$
CREATE DEFINER=`bb5260f9774b53`@`%` PROCEDURE `insert_beer`(
	in beerid varchar(255),
	in name varchar(80),
    in abv double,
    in brewery varchar(80),
    in imageurl varchar(255),
    in country varchar(50),
    in volume double,
    in servingtype varchar(10)

    
)
BEGIN
	insert into beers (beers.beerid, beers.name, beers.abv, beers.brewery, beers.imageurl, beers.Country, beers.volume, beers.servingtype)
	select * from (select beerid, name, abv, brewery, imageurl, country, volume, servingtype) AS tmp
	where not exists (
		select beers.beerid from beers WHERE beers.beerid = beerid
		) LIMIT 1;
	
        
	
END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`bb5260f9774b53`@`%` PROCEDURE `update_beer`(
	in id varchar(255), 
	in name varchar(80),
    in abv double,
    in manufacturer varchar(80),
    in imageurl varchar(255),
    in country varchar(50),
    in volume double,
    in servingtype varchar(10)
    
)
BEGIN

	if exists(select * from beers where beers.beerid = id) then
		update beers 
        set beers.name = name, beers.abv = abv, beers.manufacturer = manufacturer,
			beers.imageurl = imageurl, beers.country = country, beers.volume = volume,
			beers.servingtype = servingtype
			where id = beers.beerid;
	end if;
END$$
DELIMITER ;

```

* Set an enviroment variable named 1DV608_PROJECT_DATABASE_URL like this  
mysql://USERNAME:PASSWORD@HOST_URL/DATABASE_NAME?reconnect=true



##Vision
The vision for this project was to create an application that can list the sortiment of beers for the different pubs in Kalmar and their prices, since it's not that fun to got to the same pub and drink the same bland "stor stark" every friday night.
The idea was that users could comment on the beers/pubs and leave a rating and maybe upload pictures of their beers, but as of now only an administration can add beers/pubs (since I'm ppretty time optimistic).

##Use cases

###Use case 1 - View Pubs
####Main  
1. User navigates to the page.  
2. System presents a list of pubs  
3. User chooses a pub to view from the list  
4. System presents the pub to the user

####Alternate 1A  
1. User navigates to the page via a bookmark  
2. The pub is no longer in the system  
3. System presents an error page  
4. User navigates back to the fron-page, does step 1 in Main  

###Use case 2 - View Beer  
####Main  
1. Use case 1  
2. User chooses a beer from the list of available ones.  
3. The system presents a view of the beer to the user  

####Alternate 1A  
1. User navigates to the page via a bookmark  
2. The beer is no longer in the system  
3. System presents an error page  
4. User navigates back to the front-page, step 1 in Main  

###Use case 3 - Add Beer  
Preconditions: User is logged in as administrator
####Main  
1. User navigates to the administration-part of the app  
2. System presents user with administration-actions  
3. User chooses to add a beer to the system  
4. System asks for information about the beer  
5. User provides said information  
6. The system saves the beer to the database  

####Alternate 6A  - Information could not be save (did not pass validation, already exists etc)  
1. The system presents an error message to the user about what's wrong  
2. Step 4 in main scenario  


###Use case 4 - Add Pub  
Preconditions: User is logged in as administrator
####Main  
1. User navigates to the administration-part of the app  
2. System presents user with administration-actions  
3. User chooses to add a pub to the system  
4. System asks for information about the pub  
5. User provides said information  
6. The system saves the pub to the database  

####Alternate 6A  - Information could not be save (did not pass validation, already exists etc)  
1. The system presents an error message to the user about what's wrong  
2. Step 4 in main scenario  


##Test Cases  
* Post data without any information
* Post data with some fields left blank
* Post data with script tags
* Post data with text-values for numeric fields and vice verca
* Try accessing pubs and beers that do not exists (with get-vars)
* Test-cases for login found at https://github.com/dntoll/1DV608/blob/master/Assignments/Assignment_2/Assignment2_Test_Cases_Mandatory.md
