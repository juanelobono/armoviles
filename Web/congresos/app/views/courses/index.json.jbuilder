json.array!(@courses) do |course|
  json.extract! course, :id, :nombre, :descripcion, :activo, :dia_hora, :duracion
  json.url course_url(course, format: :json)
end
