# Ivan Vaskovic - final project for PHP - IT Bootcamp class/november 2021

## Project name : getDev(s);

## Description: 

### Web app where IT companies can hire developers

--------------------------------------------------------------------------------------------------------------------------
User types:

Developer - can create a developer profile, and browse other developers and companies. Have the ability to edit and delete his/her profile.

Company - can create a company profile, browse other developers and companies, create projects and hire developers. Have the ability to add/remove developers to project(s), and to edit/delete company profile. 
-------------------------------- NOTE: work still in progress!!!

Admin - have unlimited access to the whole web app, can edit/delete every type of profile and project, have access to basic CRUD operations 
-------------------------------- NOTE: work still in progress!!!

---------------------------------------------------------------------------------------------------------------------------

The database is primarily initialized from ./database/get_dev_db.sql file. 

3 initial profile types for testing are also added : 

    Login info:

    // admin   => email: admin@admin;       pass: admin         !!  note: admin mode still buggy
    // company => email: company@company;   pass: company       !!  note: company mode still buggy    
    // dev     => email: dev@dev;           pass: dev
    

User instruction: 
    
    Copy whole project in www (for WAMP) of xtdocs (for XAMPP), make sure you have your local server running, and open index.html file.
