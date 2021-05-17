// $(document).ready(function() {
//     $('.rating').barrating({
//         theme: 'fontawesome-stars',
//         onSelect: function(value, text, event) {

//             // Get element id by data-id attribute
//             var el = this;
//             var el_id = el.$elem.data('id');
//             // rating was selected by a user
//             if (typeof (event) !== 'undefined') {

//                 var split_id = el_id.split("_");
//                 var postid = split_id[1]; // postid

//                 // AJAX Request
//                 $.ajax({
//                     url: 'rating.php',
//                     type: 'post',
//                     data: {postid: postid, rating: value},
//                     dataType: 'json',
//                     success: function(data) {
//                         // Update average
//                         var average = data['averageRating'];
//                         $('#avgrating_' + postid).text(average);
//                     }
//                 });
//             }
//         }
//     });
// });
$(function () {
    $(".rateyo").rateYo().on("rateyo.change",function (e, data) {
        var rating = data.rating;
        
        $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
        $(this).parent().find('.result').text('rating :'+ rating);
        $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
    });
});
$(function () {
    $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
        var rating = data.rating;
        $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
        $(this).parent().find('.result').text('rating :'+ rating);
        $(this).parent().find('input[name=ratingSearch]').val(rating); //add rating value to input field
    });
});
