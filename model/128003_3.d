format 223

classinstance 128131 class_ref 128131 // Request
  name ""   xyz 128 4 2000 life_line_z 2000
classinstance 129027 class_ref 128259 // ArrayValidator
  name ""   xyz 280 4 2000 life_line_z 2000
durationcanvas 128387 classinstance_ref 128131 // :Request
  xyzwh 150 92 2010 11 227
end
durationcanvas 129155 classinstance_ref 129027 // :ArrayValidator
  xyzwh 317 190 2010 11 27
end
durationcanvas 129667 classinstance_ref 129027 // :ArrayValidator
  xyzwh 317 232 2030 11 27
end
durationcanvas 129923 classinstance_ref 129027 // :ArrayValidator
  xyzwh 317 275 2010 11 47
end
durationcanvas 130691 classinstance_ref 129027 // :ArrayValidator
  xyzwh 317 149 2010 11 28
end
lostfoundmsgsupport 131971 xyz 29 94 2015
reflexivemsg 128643 synchronous
  to durationcanvas_ref 128387
  yz 121 2015 explicitmsg "rule()"
  show_full_operations_definition default show_class_of_operation default drawing_language default show_context_mode default
  label_xy 168 104
msg 129283 synchronous
  from durationcanvas_ref 128387
  to durationcanvas_ref 129155
  yz 190 2015 explicitmsg "setData()"
  show_full_operations_definition default show_class_of_operation default drawing_language default show_context_mode default
  args "$data"
  label_xy 189 176
msg 129795 synchronous
  from durationcanvas_ref 128387
  to durationcanvas_ref 129667
  yz 232 2015 explicitmsg "validate()"
  show_full_operations_definition default show_class_of_operation default drawing_language default show_context_mode default
  label_xy 197 218
msg 130051 synchronous
  from durationcanvas_ref 128387
  to durationcanvas_ref 129923
  yz 275 2015 explicitmsg "getData()"
  show_full_operations_definition default show_class_of_operation default drawing_language default show_context_mode default
  label_xy 201 261
msg 130179 return
  from durationcanvas_ref 129923
  to durationcanvas_ref 128387
  yz 308 2020 explicitmsg "data"
  show_full_operations_definition default show_class_of_operation default drawing_language default show_context_mode default
  label_xy 209 294
msg 130819 synchronous
  from durationcanvas_ref 128387
  to durationcanvas_ref 130691
  yz 149 2015 explicitmsg "new"
  show_full_operations_definition default show_class_of_operation default drawing_language default show_context_mode default
  label_xy 208 135
msg 132099 found_synchronous
  from lostfoundmsgsupport_ref 131971
  to durationcanvas_ref 128387
  yz 92 2015 explicitmsg "validate()"
  show_full_operations_definition default show_class_of_operation default drawing_language default show_context_mode default
  label_xy 73 78
preferred_whz 1418 907 1
end
