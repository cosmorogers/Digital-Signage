/**
 * Created by chris on 08/08/14.
 */
$(function() {

    var progress = $('#progress'),
        messages = $('#messages');

    messages.cycle();

    messages.on( 'cycle-initialized cycle-before', function( e, opts ) {
        progress.stop(true).css( 'width', 0 );
    });

    messages.on( 'cycle-initialized cycle-after', function( e, opts ) {
        if ( ! messages.is('.cycle-paused') )
            progress.animate({ width: '100%' }, opts.timeout, 'linear' );
    });

    messages.on( 'cycle-paused', function( e, opts ) {
        progress.stop();
    });

    messages.on( 'cycle-resumed', function( e, opts, timeoutRemaining ) {
        progress.animate({ width: '100%' }, timeoutRemaining, 'linear' );
    });
})