
/**
 * Created by upcesar on 08/28/15.
 */

$(function() {

    Number.prototype.formatMoney = function(c, d, t){
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
       return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
     };

    $.fn.extend({
      initAutoNumeric: function(){
        
        //alert('autonumeric-fn');

        $('.currency').autoNumeric();

        $('.currency').autoNumeric('update', {
            aSep: '.', 
            wEmpty: '',
            aSign: "R$ ",
            aDec: ',',
            mDec: 2,
            vMin : -9999999
        });

        $('.numeric').autoNumeric();

        $('.numeric').autoNumeric('update', {
            aSep: '.', 
            wEmpty: '',
            aSign: "",
            aDec: ',',
            mDec: 2,
            vMin : -9999999
        });

        $('.percent').autoNumeric();

        $('.percent').autoNumeric('update', {
            aSep: '.', 
            wEmpty: '',
            aSign: " %",
            pSign: 's',
            aDec: ',',
            mDec: 2,
            vMin : -9999999
        });
      }
    });
});

$(document).ready(function() {

/*  Currency format
        *****************************
        */
    $(this).initAutoNumeric();
    

    /*  Currency format
        *****************************
    */

});