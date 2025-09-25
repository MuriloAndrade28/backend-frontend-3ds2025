import React from "react";
import { NavigationContainer } from "@react-navigation/native";
import { createStackNavigator } from "@react-navigation/stack";

import Home from "./pages/Home";
import Estados from "./pages/Estados";
import Cursos from "./pages/Cursos";   

const Menu = createStackNavigator();

function Routes() {
  return (
    <NavigationContainer>
      <Menu.Navigator>
        <Menu.Screen
          name="Home"
          component={Home}
          options={{ headerShown: false }}
        />
        <Menu.Screen name="Estados" component={Estados} />
        <Menu.Screen name="Cursos" component={Cursos} />  
      </Menu.Navigator>
    </NavigationContainer>
  );
}

export default Routes;
