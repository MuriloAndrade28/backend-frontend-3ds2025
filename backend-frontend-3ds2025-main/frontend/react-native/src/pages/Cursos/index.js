import React, { useCallback, useEffect, useState } from "react";
import {
  SafeAreaView,
  Text,
  FlatList,
  ActivityIndicator,
  RefreshControl,
  View,
  TextInput,
  TouchableOpacity,
} from "react-native";

// >>> Ajuste para a URL onde você colocar a API de Curso <<<
const API_BASE = "http://localhost/3ds-exemplo/backend/api_curso.php";

function useFetch(url) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const load = useCallback(async () => {
    setLoading(true);
    setError(null);
    try {
      const res = await fetch(url);
      const json = await res.json();
      if (!json.success) throw new Error(json.error || "Erro na API");
      setData(json.data);
    } catch (err) {
      setError(err.message);
      setData(null);
    } finally {
      setLoading(false);
    }
  }, [url]);

  useEffect(() => {
    load();
  }, [load]);

  return { data, loading, error, refresh: load };
}

export default function Cursos() {
  const [id, setId] = useState("");
  const [url, setUrl] = useState(API_BASE);
  const { data, loading, error, refresh } = useFetch(url);

  return (
    <SafeAreaView style={{ flex: 1, padding: 16 }}>
      <Text style={{ fontSize: 22, fontWeight: "700" }}>
        Cursos (API do projeto)
      </Text>

      <View
        style={{
          flexDirection: "row",
          marginTop: 12,
          gap: 8,
          alignItems: "center",
        }}
      >
        <TextInput
          placeholder="Filtrar por ID (opcional)"
          value={id}
          onChangeText={setId}
          keyboardType="number-pad"
          style={{ flex: 1, borderWidth: 1, padding: 8, borderRadius: 8 }}
        />
        <TouchableOpacity
          onPress={() => setUrl(id ? `${API_BASE}?id=${id}` : API_BASE)}
          style={{
            paddingHorizontal: 12,
            paddingVertical: 10,
            borderWidth: 1,
            borderRadius: 8,
          }}
        >
          <Text>Buscar</Text>
        </TouchableOpacity>
      </View>

      {loading && <ActivityIndicator size="large" style={{ marginTop: 24 }} />}
      {error && (
        <Text style={{ color: "red", marginTop: 12 }}>Erro: {error}</Text>
      )}

      {Array.isArray(data) && (
        <FlatList
          style={{ marginTop: 12 }}
          data={data}
          keyExtractor={(item) => String(item.cur_id)}
          refreshControl={
            <RefreshControl refreshing={loading} onRefresh={refresh} />
          }
          renderItem={({ item }) => (
            <View
              style={{
                padding: 12,
                borderWidth: 1,
                borderRadius: 10,
                marginBottom: 8,
              }}
            >
              <Text style={{ fontSize: 16, fontWeight: "600" }}>
                {item.cur_nome}
              </Text>
              <Text>ID: {item.cur_id}</Text>
            </View>
          )}
        />
      )}
    </SafeAreaView>
  );
}
