json.array!(@enrollments) do |enrollment|
  json.extract! enrollment, :id, :fecha_alta
  json.url enrollment_url(enrollment, format: :json)
end
