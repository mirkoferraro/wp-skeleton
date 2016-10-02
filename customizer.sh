themename='TEST';
themedir='test';

sed -i "" "s/Theme Name: WpSkeleton/Theme Name: $themename/" public/app/themes/skeleton/style.css
sed -i "" "s/define( 'WP_DEFAULT_THEME', 'skeleton' );/define( 'WP_DEFAULT_THEME', '$themedir' );/" public/wp-config.php
mv "public/app/themes/skeleton" "public/app/themes/$themedir"
