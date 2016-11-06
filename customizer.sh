projectfile=".project"

## Read .project file
while read project_config
do
  eval $project_config
done < $projectfile

## Save currents
current_themename=$themename
current_themedir=$themedir
current_authorname=$authorname
current_authorurl=$authorurl

## Read from user inputs
echo "Your new theme name (current: $current_themename):"
read themename

echo "Your new theme directory name (current: $current_themedir):"
read themedir

echo "Your name (current: $current_authorname):"
read authorname

echo "Your url (current: $current_authorurl):"
read authorurl

## Check for empty inputs
if [ -z "$themename" ]; then
	themename=$current_themename;
fi

if [ -z "$themedir" ]; then
	themedir=$current_themedir;
fi

if [ -z "$authorname" ]; then
	authorname=$current_authorname;
fi

if [ -z "$authorurl" ]; then
	authorurl=$current_authorurl;
fi

## Encode URL-type variables
encoded_current_authorurl="${current_authorurl/\/\//\\/\\/}"
encoded_authorurl="${authorurl/\/\//\\/\\/}"

## Theme name
sed -i "" "s/Theme Name: $current_themename/Theme Name: $themename/" public/app/themes/skeleton/style.css
sed -i "" "s/Author: $current_authorname/Author: $authorname/" public/app/themes/skeleton/style.css
sed -i "" "s/define( 'WP_DEFAULT_THEME', '$current_themedir' );/define( 'WP_DEFAULT_THEME', '$themedir' );/" public/wp-config.php

## Footer credits
sed -i "" "s/$encoded_current_authorurl/$encoded_authorurl/"  public/app/themes/skeleton/views/footer.php
sed -i "" "s/$current_authorname/$authorname/"  public/app/themes/skeleton/views/footer.php
sed -i "" "s/$current_authorname/$authorname/"  public/app/themes/skeleton/views/footer.php

## Wp-admin credits
sed -i "" "s/$encoded_current_authorurl/$encoded_authorurl/" public/app/mu-plugins/functions/wp-admin.php
sed -i "" "s/$current_authorname/$authorname/" public/app/mu-plugins/functions/wp-admin.php

## Theme directory
mv "public/app/themes/$current_themedir" "public/app/themes/$themedir"

## Save .project file
rm $projectfile
touch $projectfile
echo "themename=\"$themename\"" >> $projectfile
echo "themedir=\"$themedir\"" >> $projectfile
echo "authorname=\"$authorname\"" >> $projectfile
echo "authorurl=\"$authorurl\"" >> $projectfile
