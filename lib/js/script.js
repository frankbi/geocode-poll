$( document ).ready(function() {

	var stat = true;

	$(".selection").click(function() {
		if (stat) {

			var thisClass = (this.className).replace("selection", "").trim();

			$.ajax({
				url: "post.php",
				type: "POST",
				data: { "ans": thisClass },
				success: function(d) {

					var ketchup = 0,
						mustard = 0,
						both = 0,
						nothing = 0,
						total_num = 0;

					var data = JSON.parse(d);

					stat = false;

					for (var i = 0; i < data.length; i++) {
						if (data[i].ans == "both")
							both = parseInt(data[i].num_ans);
						if (data[i].ans == "ketc")
							ketchup = parseInt(data[i].num_ans);
						if (data[i].ans == "must")
							mustard = parseInt(data[i].num_ans);
						if (data[i].ans == "noth")
							nothing = parseInt(data[i].num_ans);
						total_num += parseInt(data[i].num_ans);
					}

					$(".ketchup").html("<h4>KETCHUP: " + get_percent(ketchup) + "</h4>");
					$(".mustard").html("<h4>MUSTARD: " + get_percent(mustard) + "</h4>");
					$(".both").html("<h4>BOTH: " + get_percent(both) + "</h4>");
					$(".nothing").html("<h4>NOTHING: " + get_percent(nothing) + "</h4>");

					function get_percent(type) {
						return (Math.round((type / total_num)*100)).toString() + "%";
					}

				}
			});
		}
	});

});