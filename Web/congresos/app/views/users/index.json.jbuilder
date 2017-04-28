json.array!(@users) do |user|
  json.extract! user, :id, :nombre, :apellido, :email, :password, :fecha_nacimiento, :domicilio, :telefono, :dni, :piso, :departamento, :legajo, :activo
  json.url user_url(user, format: :json)
end
