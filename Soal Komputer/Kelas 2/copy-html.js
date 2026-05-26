import fs from 'fs';
import path from 'path';

const buildDir = 'build';
const htmlFile = path.join(buildDir, 'index.html');
const phpFile = path.join(buildDir, 'index.php');

if (fs.existsSync(htmlFile)) {
    let html = fs.readFileSync(htmlFile, 'utf8');

    const phpHeader = `<?php
$title = "Football Info";
$desc = "Latest football news and live scores";
$image = "https://imgchest.com/upload"; // Placeholder

// Dynamic logic for routes
$url = $_SERVER['REQUEST_URI'];
if (strpos($url, '/news/') !== false) {
    // Fetch news title from DB if needed
}
?>
`;

    html = html.replace('<title>', '<title><?php echo $title; ?></title><!--');
    html = html.replace('</title>', '-->');
    
    // Inject meta tags
    const metaTags = `
    <meta name="description" content="<?php echo $desc; ?>">
    <meta property="og:title" content="<?php echo $title; ?>">
    <meta property="og:description" content="<?php echo $desc; ?>">
    <meta property="og:image" content="<?php echo $image; ?>">
    <meta name="twitter:card" content="summary_large_image">
    `;
    
    html = html.replace('</head>', `${metaTags}\n</head>`);

    fs.writeFileSync(phpFile, phpHeader + html);
    console.log('Successfully created index.php from index.html');
} else {
    console.error('build/index.html not found. Run build first.');
}
