echo "Your new theme name (MyTheme):"
read themename

echo "Your new theme directory name (mytheme):"
read themedir

echo "Your name (as author):"
read authorname

echo "Your url (http://yoursite.it):"
read authorurl

authorurl="${authorurl/\/\//\\/\\/}"

## Theme name
sed -i "" "s/Theme Name: WpSkeleton/Theme Name: $themename/" public/app/themes/skeleton/style.css
sed -i "" "s/Author: Mirko Ferraro/Author: $authorname/" public/app/themes/skeleton/style.css
sed -i "" "s/define( 'WP_DEFAULT_THEME', 'skeleton' );/define( 'WP_DEFAULT_THEME', '$themedir' );/" public/wp-config.php

## Footer credits
sed -i "" "s/\/\/skeleton.com/$authorurl/"  public/app/themes/skeleton/views/footer.php
sed -i "" "s/Skeleton/$authorname/"  public/app/themes/skeleton/views/footer.php
sed -i "" "s/Skeleton/$authorname/"  public/app/themes/skeleton/views/footer.php

## Wp-admin credits
sed -i "" "s/http:\/\/www.mirkoferraro.it/$authorurl/" public/app/mu-plugins/functions/wp-admin.php
sed -i "" "s/Mirko Ferraro/$authorname/" public/app/mu-plugins/functions/wp-admin.php

## Theme directory
mv "public/app/themes/skeleton" "public/app/themes/$themedir"
