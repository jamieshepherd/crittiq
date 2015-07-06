// First lets create our drawing surface out of existing SVG element
// If you want to create new surface just provide dimensions
// like s = Snap(800, 600);
var s = Snap("#svg");
// Lets create big circle in the middle:
var circle = s.path({
 path: loop,
 fill: "#bada55",
 stroke: "#c00",
 strokeWidth: 0,
 strokeLinecap: "round"
});
var label = s.text(30,60, "8.9");
label.attr({
    fill: "#ffffff"
});
