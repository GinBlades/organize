import $ from "jquery";
import _ from "lodash";
import "foundation-sites";
import "jquery-ui/ui/core";
import "jquery-ui/ui/widgets/datepicker";
import "jquery-ui/ui/widgets/slider";

// Parameters
// name - string - Use for label
// field - string - Identify field to be replaced by slider
// min - number - Integer value for slider minimum
// max - number - Integer value for slider maximum
class Slider {
    constructor(name, field, min = 0, max = 10) {
        this.name = name;
        // parameterized name used for HTML attributes
        this.pName = _.kebabCase(name);
        this.min = min;
        this.max = max;
        this.$field = $(field);
    }

    template() {
        return `<div>
            <label>${this.name}</label>
            <div id="${this.pName}-slider">
                <div id="${this.pName}-handle" class="ui-slider-handle"></div>
            </div>
        </div>`;
    }

    render() {
        $(this.template()).insertAfter(this.$field);
        let handle = $(`#${this.pName}-handle`);
        let _this = this;

        $(`#${this.pName}-slider`).slider({
            min: this.min,
            max: this.max,
            step: 1,
            create: function(event, ui) {
                let $this = $(this);
                $this.slider("value", _this.$field.val());
                handle.text($this.slider("value"));
            },
            slide: function(event, ui) {
                handle.text(ui.value);
                _this.$field.val(ui.value);
                console.log(_this.$field);
            }
        });
    }
}

$(document).ready(() => {
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
    });

    let difficultySlider = new Slider("Difficulty", ".slider#task_difficulty");
    difficultySlider.render();

    let prioritySlider = new Slider("Priority", ".slider#task_priority", 0, 5);
    prioritySlider.render();
});
