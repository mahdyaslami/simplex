format 223

classcanvas 128127 class_ref 128511 // HttpException
  classdiagramsettings member_max_width 0 end
  xyz 237.5 118.5 2000
end
classcanvas 128255 class_ref 128767 // MethodNotAllowedException
  classdiagramsettings member_max_width 0 end
  xyz 195.5 237 2006
end
classcanvas 128511 class_ref 128895 // NotFoundException
  classdiagramsettings member_max_width 0 end
  xyz 40.5 237 2011
end
classcanvas 128767 class_ref 128639 // Exception
  classdiagramsettings member_max_width 0 end
  xyz 248.5 40.5 2006
end
relationcanvas 128383 relation_ref 128511 // <generalisation>
  from ref 128255 z 2007 to ref 128127
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128639 relation_ref 128639 // <generalisation>
  geometry VHV unfixed
  from ref 128511 z 2012 to point 96 196
  line 129023 z 2012 to point 278 196
  line 129151 z 2012 to ref 128127
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
relationcanvas 128895 relation_ref 128383 // <generalisation>
  from ref 128127 z 2007 to ref 128767
  no_role_a no_role_b
  no_multiplicity_a no_multiplicity_b
end
end
