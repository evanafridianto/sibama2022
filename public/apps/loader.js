$(window).bind("beforeunload", function() {
    $("#content-body").waitMe({
        effect: "roundBounce",
        text: "<span class='text-secondary'>Loading...</span>",
        bg: "rgba(255,255,255,0.7)",
        color: "#6673fd",
        maxSize: "",
        waitTime: -1,
        textPos: "vertical",
        fontSize: "",
        source: "",
        onClose: function() {},
    });
});
