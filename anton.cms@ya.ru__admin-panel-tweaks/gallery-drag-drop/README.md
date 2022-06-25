<style>

    /* Spinner CSS */
    div#loader {
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #e4e4e4; /* Couch-like */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        position: absolute;
        top: 50%;
        left: 10%;
        animation: spin 0.5s linear infinite;
        transform: translate3d(-50%, -50%, 0);
    }

    @keyframes spin {
        0% { transform: translate3d(-50%, -50%, 0) rotate(0deg); }
        100% { transform: translate3d(-50%, -50%, 0) rotate(360deg); }
    }

    #k_overlay { display: none!important;} /* can disable default dark overlay */
</style>

<div id="loader"></div>

