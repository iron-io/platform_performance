#Getting Started

1. Set up proper credentials in config.ini (iron_worker,iron_mq)
2. Deploy to Phpfog or CloudControl
3. Push start test

##How to install app on clouds:

###AppFog
-   Create new Appfog cloud and new app
-   Clone Appfog app - 'git clone git_appgfog_path' (check Source Code section of Appfog)
-   Clone this repo 'git clone https://github.com/iron-io/platform_performance.git'
-   Copy all files from this repo folder to appfog application folder - 'cp php_example/* your_appfog_folder/ -r'
-   Set proper credentials in config.ini (you could get token and project_id from https://hud.iron.io/)
-   Redeploy appfog app - 'git add -A;git commit -m "first deploy";git push'
-   Open your app url in browser (you should see smth like this http://imageworkerdemo.phpfogapp.com/)

###CloudControl
-   Install cctrlapp: 'sudo easy_install cctrl'
-   Make folder for cloudcontrol app - 'mkdir cloudcontrol_app_folder'
-   Clone this repo 'git clone https://github.com/iron-io/platform_performance.git'
-   Copy all files from this repo folder to cloudcontrol_app_folder - 'cp php_example/* cloudcontrol_app_folder/ -r'
-   Set proper credentials in config.ini (you could get token and project_id from https://hud.iron.io/)
-   Go into cloudcontrol_app_folder - 'cd cloudcontrol_app_folder'
-   Create app -'cctrlapp APP_NAME create php'
-   Commit app - 'git add -A;git commit -m "first deploy"
-   Push app - 'cctrlapp APP_NAME/DEP_NAME push'
-   Deploy app - 'cctrlapp APP_NAME/DEP_NAME deploy'
-   Open your app url in browser (you should see smth like this http://iron2.cloudcontrolled.com/)

###Heroku
-   Clone this repo 'git clone https://github.com/iron-io/platform_performance.git'
-   Set proper credentials in config.ini (you could get token and project_id from https://hud.iron.io/)
-   Create Heroku app - 'heroku create'
-   Push Heroku app - 'git push heroku master'
-   Open your app url in browser (you should see smth like this http://evening-flower-2993.herokuapp.com/)


