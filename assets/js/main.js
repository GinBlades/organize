import $ from "jquery";
import _ from "lodash";
import "foundation-sites";
import "jquery-ui/ui/core";
import "jquery-ui/ui/widgets/datepicker";
import "jquery-ui/ui/widgets/slider";
import { Slider } from "./lib/slider";


$(document).ready(() => {
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });

    let difficultySlider = new Slider("Difficulty", ".slider#task_difficulty");
    difficultySlider.render();

    let prioritySlider = new Slider("Priority", ".slider#task_priority", 0, 5);
    prioritySlider.render();
});
