function flask_package() {
    echo 'Initializing a new Flask package'
    echo ''
    wget "https://github.com/BlackIQ/apm-flask/archive/refs/tags/flask-apm-1.0.0.zip"
    unzip flask-apm-1.0.0.zip
    rm -rf flask-apm-1.0.0.zip
    cd apm-flask-flask-apm-1.0.0
    rm -rf .git
    git init
    git add -A
    git commit -m "Init of flask apm package"
    echo ''
    echo 'Project created.'
    echo 'cd apm-flask-flask-apm-1.0.0'
}

function php_package() {
    echo 'Initializing a new Php package'
    echo ''
    wget "https://github.com/BlackIQ/apm-php/archive/refs/tags/php-apm-1.0.0.zip"
    unzip php-apm-1.0.0.zip
    rm -rf php-apm-1.0.0.zip
    cd apm-php-php-apm-1.0.0
    rm -rf .git
    git init
    git add -A
    git commit -m "Init of php apm package"
    echo ''
    echo 'Project created.'
    echo 'cd apm-php-php-apm-1.0.0'
}

function static_package() {
    echo 'Initializing a new Static package'
    echo ''
    wget "https://github.com/BlackIQ/static-apm/archive/refs/tags/static-apm-1.0.0.zip"
    unzip static-apm-1.0.0.zip
    rm -rf static-apm-1.0.0.zip
    cd apm-static-static-apm-1.0.0
    rm -rf .git
    git init
    git add -A
    git commit -m "Init of static apm package"
    echo ''
    echo 'Project created.'
    echo 'cd apm-static-static-apm-1.0.0'
}

if [ ! -z $1 ]
    then
    if [ $1 == '-h' ]
        then
        echo 'Manual'
    elif [ $1 == '--help' ]
        then
        echo 'Manual'
    elif [ $1 == '-c' ]
        then
        if [ ! -z $2 ]
            then
            if [ $2 == 'flask' ]
                then
                flask_package
            elif [ $2 == 'php' ]
                then
                php_package
            elif [ $2 == 'static' ]
                then
                static_package
            else
                echo 'Package could not be founded.'
                echo 'See manual with -h or --help for packages.'
            fi
        else
            echo 'Enter a package name.'
            echo 'See manual with -h or --help for packages.'
        fi
    else
        echo 'Argument did not found.'
    fi
else
    echo 'Welcome to APM.'
    echo 'You can see manual by -h or --help'
fi