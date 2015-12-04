#1dv608 - Project
Repository for the project in the course Web development with php

##Written essay about the project
[Can be found here](https://docs.google.com/document/d/1aq3VP5VokMfXT0wbolyq2_nbvumBJw40uL2SH3c1-Jk/edit?usp=sharing)

##Installation
// TODO

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
