# Laravel Clean Architecture

Este documento describe la arquitectura y las decisiones de diseño adoptadas en este proyecto basado en Clean Architecture.

## Visión General

El proyecto implementa Clean Architecture según los principios de Robert C. Martin, organizando el código en capas concéntricas, cada una con su propia responsabilidad y nivel de abstracción:

1. **Domain** (núcleo): Contiene la lógica de negocio pura y las entidades del dominio.
2. **Application**: Coordina el flujo de datos entre la capa de dominio y la infraestructura.
3. **Infrastructure**: Implementa las interfaces definidas en las capas internas y maneja la interacción con frameworks, bases de datos, etc.

## Estructura de Carpetas

```
app/
├── Domain/               # Núcleo de la aplicación
│   ├── Entities/         # Modelos de dominio
│   ├── Interfaces/       # Contratos para repositorios y servicios
│   ├── ValueObjects/     # Objetos de valor inmutables
│   ├── Exceptions/       # Excepciones del dominio
│   └── Enums/            # Enumeraciones del dominio
│
├── Application/          # Casos de uso y lógica de aplicación
│   ├── UseCases/         # Implementación de los casos de uso
│   └── DTOs/             # Objetos de transferencia de datos
│
├── Infrastructure/       # Implementaciones concretas 
│   ├── Http/             # Controladores y middleware (Laravel)
│   ├── Repositories/     # Implementaciones de los repositorios
│   ├── Services/         # Implementaciones de servicios
│   ├── Providers/        # Providers de servicios (Laravel)
│   └── Mappers/          # Convertidores entre entidades y modelos
│
└── Models/               # Modelos de Eloquent (Laravel)
```

## Principios Fundamentales

1. **Regla de Dependencia**: Las dependencias siempre apuntan hacia adentro. Las capas externas dependen de las internas, nunca al revés.
2. **Inversión de Dependencias**: Las capas internas definen interfaces que son implementadas por las capas externas.
3. **Entidades Inmutables**: Las entidades del dominio son inmutables para garantizar la integridad del estado.
4. **Value Objects**: Usamos objetos de valor para encapsular conceptos del dominio con validación y comportamiento propios.

## Flujo de Datos

1. Request HTTP → Controller → DTO → UseCase → Entities/Repositories → Response

## Decisiones de Diseño

- **Servicios Stateless**: Los servicios no mantienen estado, facilitando las pruebas y la concurrencia.
- **DTOs para transferencia**: Usamos DTOs para transferir datos entre capas, evitando dependencias del dominio hacia frameworks externos.
- **Validación en dos niveles**: Validación de entrada en los Request de Laravel y validación de dominio en Value Objects.

## Integraciones con Laravel

Este proyecto utiliza Laravel como framework web pero mantiene una clara separación:

- Los modelos Eloquent están en la capa de infraestructura
- Controladores y Requests en la capa de infraestructura
- Providers de Laravel para configurar la inyección de dependencias

## Evolución Futura

La arquitectura está diseñada para facilitar:

- Cambios en la interfaz de usuario sin afectar la lógica de negocio
- Posibilidad de reemplazar Laravel por otro framework
- Facilidad para añadir nuevas funcionalidades manteniendo la separación de responsabilidades 