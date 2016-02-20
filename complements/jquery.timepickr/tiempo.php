<html>
<head>
<link rel="stylesheet" type="text/css" href="jquery-ui.css" />

<script src="jquery-1.7.1.js"></script>
<script src="jquery-ui.js"></script>

<script src="jquery.timepickr.js"></script>
</head>

<body>
<input class="timepickr-example" readonly/>
<script type="text/javascript">
$('.timepickr-example:eq(0)').timepickr({
convention: 12,
format: '{h}:{m} {suffix}',
hoverIntent: false
});
</script>
</body>
</html>