<?php
if($_COOKIE["rl"]==NULL){
?>
<script type="text/javascript">
if(top!=self){
top.location=self.location;
}
</script>
<script type="text/javascript">document.location.href='../logout.php'</script>
<?php
}
?>