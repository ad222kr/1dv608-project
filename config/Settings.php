<?php

class Settings {

    /**
     * Enviroment variable containing database-information such as username,
     * password, server and database. Make sure this is set as a variable env.
     */
    const DATABASE_ENV_PATH = "1DV608_PROJECT_DATABASE_URL";

    /**
     * If debug mode, throws errors from e.g. Database and shows them
     * If not, shows an error message to the user to hide stack trace
     * Also shows errors
     */
    const DEBUG_MODE = FALSE;


    const ERROR_LOG_PATH = "errorlog.txt";




}