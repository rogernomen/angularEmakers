$('#rating_ok').hide();

// starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
  var Starrr;

  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: starcount,
      numStars: 5,
      change: function(e, value) {}
    };

    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;

      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }

    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;

      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
      	_results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
        
      }
      return _results;
    };

    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };

    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;

      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      }
    };

    return Starrr;

  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;

      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;

        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);

$(function() {
  return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#stars').on('starrr:change', function(e, value){
  	//$('#count').html(value);
    //$('.alert').removeClass('hide').show().delay(1000).addClass("in").fadeOut(3500);
    if(value == 1){
	    $('h2.talcenter').html('Muy Malo');
    }else if(value == 2){
	    $('h2.talcenter').html('Malo');
    }else if(value == 3){
	    $('h2.talcenter').html('Normal');
    }else if(value == 4){
	    $('h2.talcenter').html('Muy Bueno');
    }else if(value == 5){
	    $('h2.talcenter').html('Excelente');
    }
    $('#rating_value').val(value);
  });
  
});

function guardaRating(){
	var hash_rating = $('#hash_rating').val();
	var id_rating = $('#id_rating').val();
	var rating_value = $('#rating_value').val();
	var input_comentarios_sugerencias = $('#input_comentarios_sugerencias').val();
	
	$.ajax({
		type: "POST",
		url: base_url+lang_site+"/rating/saveRatingcomments",
		data: "hash_rating="+hash_rating+
			  "&id_rating="+id_rating+
			  "&rating_value="+rating_value+
			  "&input_comentarios_sugerencias="+input_comentarios_sugerencias,
		beforeSend: function(x) {
			$('#triggerError_cambiosLoading').trigger('click');
		},
		success: function(msg){
			$('#rating_save').hide();
			$('#rating_ok').show();
		}
	});
}