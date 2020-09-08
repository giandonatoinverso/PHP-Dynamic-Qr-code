<?php
/**
 * Function to generate random string.
 * The function takes an integer n as input and generates a string by concatenating n characters chosen randomly from a domain.

N.B. In our case the integer n is randomly chosen between a range of 5 and 8. I chose this "short" range to not overdo the length of the identifier
 */
function randomString($n) {

	$generated_string = "";

	$domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

	$len = strlen($domain);

	// Loop to create random string
	for ($i = 0; $i < $n; $i++) {
		// Generate a random index to pick characters
		$index = rand(0, $len - 1);

		// Concatenating the character
		// in resultant string
		$generated_string = $generated_string . $domain[$index];
	}

	return $generated_string;
}

/**
 *
 */
function getSecureRandomToken() {
	$token = bin2hex(openssl_random_pseudo_bytes(16));
	return $token;
}

/**
 * Clear Auth Cookie
 */
function clearAuthCookie() {

	unset($_COOKIE['series_id']);
	unset($_COOKIE['remember_token']);
	setcookie('series_id', null, -1, '/');
	setcookie('remember_token', null, -1, '/');
}
/**
 *
 */
function clean_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function paginationLinks($current_page, $total_pages, $base_url) {

	if ($total_pages <= 1) {
		return false;
	}

	$html = '';

	if (!empty($_GET)) {
		// We must unset $_GET[page] if previously built by http_build_query function
		unset($_GET['page']);
		// To keep the query sting parameters intact while navigating to next/prev page,
		$http_query = "?" . http_build_query($_GET);
	} else {
		$http_query = "?";
	}

	$html = '<ul class="pagination pagination-sm m-0 float-right">';

	if ($current_page == 1) {

		$html .= '<li class="page-item disabled"><a class="page-link">First</a></li>';
	} else {
		$html .= '<li class="page-item"><a class="page-link" href="' . $base_url . $http_query . '&page=1">First</a></li>';
	}

	// Show pagination links

	//var i = (Number(data.page) > 5 ? Number(data.page) - 4 : 1);

	if ($current_page > 5) {
		$i = $current_page - 4;
	} else {
		$i = 1;
	}

	for (; $i <= ($current_page + 4) && ($i <= $total_pages); $i++) {
		($current_page == $i) ? $li_class = ' class="active"' : $li_class = '';

		$link = $base_url . $http_query;

		$html = $html . '<li class="page-item"' . $li_class . '><a class="page-link" href="' . $link . '&page=' . $i . '">' . $i . '</a></li>';

		if ($i == $current_page + 4 && $i < $total_pages) {

			$html = $html . '<li class="page-item disabled"><a class="page-link">...</a></li>';

		}

	}

	if ($current_page == $total_pages) {
		$html .= '<li class="page-item disabled"><a class="page-link">Last</a></li>';
	} else {

		$html .= '<li class="page-item"><a class="page-link" href="' . $base_url . $http_query . '&page=' . $total_pages . '">Last</a></li>';
	}

	$html = $html . '</ul>';

	return $html;
}
