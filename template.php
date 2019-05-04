<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contribution summarizer output</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<style>
		body {
			font-family: 'Open Sans', sans-serif;
		}
		h1 {
			border-bottom: 2px solid black;
		}
		.month {
			text-align: left;
		}
		*[class*="contributions-"] {
			display: block;
			width: 30px;
			height: 30px;
			background-color: #2f630e;
			text-align: center;
			font-size: 14px;
			color: white;
			line-height: 30px;
		}
		.contributions- {
			display: none;
		}
		.contributions-0 {
			background-color: #ededed;
		}
		.contributions-1,
		.contributions-2,
		.contributions-3,
		.contributions-4,
		.contributions-5 {
			background-color: #84D466;
		}
		.contributions-6,
		.contributions-7,
		.contributions-8,
		.contributions-9,
		.contributions-10 {
			background-color: #66C71D;
		}
		.contributions-11,
		.contributions-12,
		.contributions-13,
		.contributions-14,
		.contributions-15 {
			background-color: #4F9D13;
		}
		.contributions-16,
		.contributions-17,
		.contributions-18,
		.contributions-19,
		.contributions-20 {
			background-color: #3E7D11;
		}
		.d-inline-block {
			display: inline-block;
		}
		.m-t-30 {
			margin-top: 30px;
		}
		.legend-block {
			vertical-align: top;
			line-height: 30px;
		}
		.p-r-5 {
			padding-right: 5px;
		}
		.p-l-5 {
			padding-left: 5px;
		}
	</style>
</head>
<body>
	<?php
		foreach ($calendar as $year => $months) {
		    echo '<h1>' . $year . '</h1>';

		    echo '<table>';
				echo '<thead>';
					echo '<th></th>';
					for ($d = 1; $d <= 31; ++$d) {
						echo '<th class="day-number">' . (int) $d . '</th>';
					}
				echo '</thead>';

				foreach ($months as $month => $days) {

                    $days[29] = isset($days[29]) ? $days[29] : null;
                    $days[30] = isset($days[30]) ? $days[30] : null;
                    $days[31] = isset($days[31]) ? $days[31] : null;

					echo '<tr>';
						echo '<th class="month">' . date('F', mktime(0, 0, 0, $month, 1)) . '</th>';
						foreach ($days as $day => $count) {
                            echo '<td class="day">';
                            	echo '<span class="contributions-' . $count . '">' . ($count ? $count : '') . '</span>';
							echo '</td>';
						}
					echo '</tr>';
				}

				echo '<tr>';
					echo '<th></th>';
					echo '<td colspan="31">';
					?>
					<div class="m-t-30">
						<span class="d-inline-block legend-block p-r-5">LESS</span>
						<span class="contributions-0 d-inline-block"></span>
						<span class="contributions-5 d-inline-block"></span>
						<span class="contributions-10 d-inline-block"></span>
						<span class="contributions-15 d-inline-block"></span>
						<span class="contributions-20 d-inline-block"></span>
						<span class="contributions-21 d-inline-block"></span>
						<span class="d-inline-block legend-block p-l-5">MORE</span>
					</div>
					<?php
					echo '</td>';
				echo '</tr>';

            echo '</table>';
		}

	?>
</body>
</html>