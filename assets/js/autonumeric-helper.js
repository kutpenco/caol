
/**
 * Created by upcesar on 08/28/15.
 */
$(document).ready(function() {

/*  Currency format
        *****************************
        */
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

    /*  Currency format
        *****************************
    */

});