
<!-- <?php
     $color = '#'.substr(md5($label->name), 0, 6);
?>

<style>
.label-info[data-id="{{$label->id}}"] .label-text {
    background-color: {{$color}};
}
</style> -->

<div class="label-info" data-id={{$label->id}}>
    <span class="label-text">{{$label->name}}</span>
</div>
