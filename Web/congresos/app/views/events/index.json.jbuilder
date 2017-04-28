json.array!(@events) do |event|
  json.extract! event, :id, :fecha_inicio, :fecha_fin, :descripcion, :lugar
  json.url event_url(event, format: :json)
end
