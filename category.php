<?php
// Define categories and their descriptions
$categories = [
    'General Works' => 'A',
    'Music' => 'M',
    'Philosophy, Psychology, Religion' => 'B',
    'Fine Arts' => 'N',
    'History - Auxiliary Sciences' => 'C',
    'Language and Literature' => 'P',
    'History (Except U.S.)' => 'D',
    'Science' => 'Q',
    'General U.S. History' => 'E',
    'Medicine' => 'R',
    'Local U.S. History' => 'F',
    'Agriculture' => 'S',
    'Geography, Anthropology, Recreation' => 'G',
    'Technology' => 'T',
    'Social Sciences' => 'H',
    'Military' => 'U',
    'Political Science' => 'J',
    'Naval Science' => 'V',
    'Law' => 'K',
    'Bibliography and Library Science' => 'Z',
    'Education' => 'L'
];

// Description texts for each category
$descriptions = [
    'A' => 'A general category for works that do not fall into specific fields, such as encyclopedias or general references.',
    'M' => 'This section focuses on musical works, including theory, history, and individual music pieces.',
    'B' => 'Covers philosophical ideas, psychological studies, and religious writings from various traditions.',
    'N' => 'Involves visual arts, painting, sculpture, architecture, and other creative expressions.',
    'C' => 'Studies of history from an academic perspective, including methods and auxiliary sciences.',
    'P' => 'Literature, linguistics, and studies related to language in all forms.',
    'D' => 'History of nations and regions, excluding the United States.',
    'Q' => 'Scientific disciplines, such as biology, chemistry, physics, and other natural sciences.',
    'E' => 'Focuses on the history of the United States, including political, social, and cultural events.',
    'R' => 'This category encompasses medical studies, healthcare, and related fields.',
    'F' => 'A collection of works focused on the history and culture of specific regions within the U.S.',
    'S' => 'This category includes agricultural sciences, farming practices, and land management.',
    'G' => 'Geographical and anthropological studies, as well as recreational activities and their impacts.',
    'T' => 'Technological innovations, engineering, and practical applications of science.',
    'H' => 'Fields of social science including sociology, psychology, economics, and anthropology.',
    'U' => 'Studies of military history, tactics, and strategy.',
    'J' => 'Political science studies focusing on governance, politics, and lawmaking processes.',
    'V' => 'Naval sciences, including naval history, technology, and strategies.',
    'K' => 'Laws, legal systems, and the study of justice across various jurisdictions.',
    'Z' => 'Bibliographies, catalogs, and the science of library organization and management.',
    'L' => 'Educational theory, teaching methods, and other related topics within the field of education.'
];

// Image URLs (replace these with actual category-specific images if needed)
$images = [
    'A' => 'https://via.placeholder.com/150',
    'M' => 'https://via.placeholder.com/150',
    'B' => 'https://via.placeholder.com/150',
    'N' => 'https://via.placeholder.com/150',
    'C' => 'https://via.placeholder.com/150',
    'P' => 'https://via.placeholder.com/150',
    'D' => 'https://via.placeholder.com/150',
    'Q' => 'https://via.placeholder.com/150',
    'E' => 'https://via.placeholder.com/150',
    'R' => 'https://via.placeholder.com/150',
    'F' => 'https://via.placeholder.com/150',
    'S' => 'https://via.placeholder.com/150',
    'G' => 'https://via.placeholder.com/150',
    'T' => 'https://via.placeholder.com/150',
    'H' => 'https://via.placeholder.com/150',
    'U' => 'https://via.placeholder.com/150',
    'J' => 'https://via.placeholder.com/150',
    'V' => 'https://via.placeholder.com/150',
    'K' => 'https://via.placeholder.com/150',
    'Z' => 'https://via.placeholder.com/150',
    'L' => 'https://via.placeholder.com/150'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Cards</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }
        .card {
            width: 250px;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-header {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .card-description {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }
        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            color: #333;
        }
    </style>
</head>
<body>

<!-- Heading -->
<h1>Explore Our Categories</h1>

<?php
// Generate cards for each category
foreach ($categories as $title => $key) {
    echo '<div class="card">';
    echo '<img src="' . $images[$key] . '" alt="' . $title . ' Image">';
    echo '<div class="card-header">' . $title . '</div>';  // Display category name instead of letter
    echo '<div class="card-description">' . $descriptions[$key] . '</div>';
    echo '</div>';
}
?>

</body>
</html>
