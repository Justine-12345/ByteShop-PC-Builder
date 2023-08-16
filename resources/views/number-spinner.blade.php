<script type="text/javascript">
    $(document).ready(function () {
    $(".form-spinner input").each(function (i, spinner) {
        if ($(this).data("type") === "text") {
            let index = $(this).data("spinner-index") || 0;
            let items = $(this).data("spinner-items");
            
            $(this).val(items[index]);
        }
    });
    
    $(".form-spinner .btn-increment").click(function () {
        let $this       = $(this);
        let input       = $this.siblings("input");
        
        if (input.data("type") === "number") {
            let step         = input.attr("step");
            let oldValue = input.val();
            let newValue = parseInt(oldValue) + parseInt(step || 1);
            let maxValue = input.attr("max");
            let minValue = input.attr("min");
            
            if (!maxValue || newValue <= maxValue)
                input.val(newValue);
            else if (input.data("spinner-loop"))
                input.val(minValue);
            else 
                input.val(maxValue);
        } else if (input.data("type") === "text") {
            let oldIndex = input.data("spinner-index") || 0;
            let items    = input.data("spinner-items");
            let newIndex = oldIndex + 1;

            if (newIndex < items.length) {
                input.val(items[newIndex]);
                input.data("spinner-index", newIndex);
            } else if (input.data("spinner-loop")){
                input.val(items[0]);
                input.data("spinner-index", 0);
            }
       }    
        
    });
    $(".form-spinner .btn-decrement").click(function () {
        let $this       = $(this);
        let input       = $this.siblings("input");
        
        if (input.data("type") === "number") {
            let step         = input.attr("step");
            let oldValue = input.val();
            let newValue = parseInt(oldValue) - parseInt(step || 1);
            let maxValue = input.attr("max");
            let minValue = input.attr("min");

            if (!minValue || newValue >= minValue)
                input.val(newValue);
            else if (input.data("spinner-loop"))
                input.val(maxValue);
            else
                input.val(minValue);
        } else if (input.data("type") === "text") { 
            let oldIndex = input.data("spinner-index") || 0;
            let items    = input.data("spinner-items");
            let newIndex = oldIndex - 1;

            if (newIndex >= 0) {
                input.val(items[newIndex]);
                input.data("spinner-index", newIndex);
            } else if (input.data("spinner-loop")){
                input.val(items[items.length - 1]);
                input.data("spinner-index", items.length - 1);
            }
        }
    });
});
</script>