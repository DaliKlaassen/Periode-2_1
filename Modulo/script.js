for (var i = 0; i < 100; i++) {
   if (i % 5 == 0 && i % 3 == 0) {
    console.log("MediaCollege");
  }
  else if (i % 3 == 0) {
    console.log("Media");
  }
  else if (i % 5 == 0) {
    console.log("College");
  }
  else {
    console.log(i);
  }
}
