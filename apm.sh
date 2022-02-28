function flask_package() {
    echo 'flask package'
}

function php_package() {
    echo 'php package'
}

function static_package() {
    echo 'static package'
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