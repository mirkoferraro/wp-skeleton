# PDF Integration Guide for [WpSkeleton](https://github.com/mirkoferraro/wp-skeleton)

Install mPDF lib withg composer:
```composer require mpdf/mpdf```

Read the [mPDF guide](https://github.com/mpdf/mpdf) and use it
```
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();
```
